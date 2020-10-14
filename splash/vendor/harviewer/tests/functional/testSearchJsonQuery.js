/**
 * Test HAR Viewer Search using JSON Query
 */
define([
  'intern',
  'intern!object',
  'intern/chai!assert',
  'require',
  './DriverUtils',
  'intern/dojo/node!leadfoot/helpers/pollUntil',
  'intern/dojo/node!leadfoot/keys',
], function(intern, registerSuite, assert, require, DriverUtils, pollUntil, keys) {
  var harViewerBase = intern.config.harviewer.harViewerBase;
  var testBase = intern.config.harviewer.testBase;

  registerSuite({
    name: 'testSearchJsonQuery',

    'testSearchJsonQuery': function() {
      // Some of these tests need a larger timeout for finding DOM elements
      // because we need the HAR to parse/display fully before we query the DOM.
      var findTimeout = intern.config.harviewer.findTimeout;
      var r = this.remote;
      var utils = new DriverUtils(r);

      var viewerURL = testBase + "tests/testSearchJsonQuery.html.php";
      var harFileURL = testBase + "tests/hars/searchHAR.har";
      var url = viewerURL + "?path=" + harFileURL;

      return r
        .setFindTimeout(findTimeout)
        .get(url)
        // Wait for the HAR to load by waiting for the Preview tab to be auto-selected
        .then(utils.cbAssertElementContainsText("css=.PreviewTab.selected", "Preview"))
        .then(utils.cbAssertCookie("regexp:searchJsonQuery"))
        // Select the DOM tab
        .findByCssSelector(".DOMTab")
        .click()
        .end()
        .findByCssSelector(".DOMTab.selected")
        .end()
        // Type JSON Query expression into the search field and press enter.
        .findByCssSelector(".tabDOMBody .searchInput")
        .type("$..request")
        .type(keys.ENTER)
        .end()
        .findByCssSelector(".tabDOMBody .domBox .results.visible")
        .end()
        .then(utils.cbAssertElementsLength(".tabDOMBody .domBox .results .memberRow", 8, findTimeout));
    }
  });
});
