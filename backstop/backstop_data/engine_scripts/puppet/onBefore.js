module.exports = async (page, scenario, vp) => {
  await require('./loadCookies')(page, scenario);

  // fix Backstop "Navigation timeout of 60000 ms exceeded"
  await page.setDefaultNavigationTimeout(0);
};
