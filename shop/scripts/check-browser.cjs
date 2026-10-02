const { chromium } = require('playwright');
const fs = require('node:fs/promises');
const assert = require('node:assert/strict');

(async () => {
  const browser = await chromium.launch();
  try {
    await fs.mkdir('test-output', { recursive: true });
    for (const [name, width, height] of [['desktop', 1440, 1000], ['mobile', 390, 844]]) {
      const page = await browser.newPage({ viewport: { width, height } });
      const errors = [];
      page.on('pageerror', error => errors.push(error.message));
      const response = await page.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
      await page.screenshot({ path: `test-output/home-${name}.png`, fullPage: true });
      assert.equal(response.status(), 200, 'Homepage HTTP status');
      assert.match(response.headers()['x-robots-tag'], /noindex/, 'Noindex header');
      assert.equal(await page.locator('#slico-title').count(), 1, 'SLICO3D homepage rendered');
      assert.equal(await page.locator('.slico-empty').count(), 1, 'Empty assortment shown');
      assert.match(await page.locator('html').getAttribute('lang'), /^de(?:-DE)?$/i, 'German HTML language');
      const logo = page.locator('.slico-brand img');
      assert.ok(await logo.evaluate(img => img.complete && img.naturalWidth > 0), 'Brand logo loads');
      assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth + 1), 'No horizontal overflow');
      for (const route of ['/shop/', '/warenkorb/', '/blog/', '/kontakt/']) {
        const res = await page.goto(`http://localhost:8080${route}`, { waitUntil: 'domcontentloaded' });
        assert.equal(res.status(), 200, `${route} is reachable`);
        assert.equal(await page.locator('.product').count(), 0, 'No sample products');
      }
      assert.deepEqual(errors, [], 'No browser JavaScript errors');
      await page.close();
    }
    const inbox = await fetch('http://localhost:8025/api/v1/messages');
    assert.equal(inbox.status, 200, 'Local inbox reachable');
    assert.ok((await inbox.json()).total >= 1, 'Test email captured');
    console.log('Desktop, mobile, empty shop and local mail checks passed.');
  } finally {
    await browser.close();
  }
})().catch(error => { console.error(error); process.exit(1); });
