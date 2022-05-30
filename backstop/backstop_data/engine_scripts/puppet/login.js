module.exports = async (page, scenario) => {
    await page.goto('http://wiki.local/index.php?title=Special:UserLogin');
    await page.click('input#wpName1');
    await page.type('input#wpName1', 'WikiSysop');
    await page.type('input#wpPassword1', 'wiki4everyone');
    await page.click('button#wpLoginAttempt');
    await page.waitForTimeout(10000);
    await page.goto(scenario.url);
};