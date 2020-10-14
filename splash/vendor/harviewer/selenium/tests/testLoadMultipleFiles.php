<?php
require_once("HARTestCase.php");

/**
 * Load multiple HAR files into the viewer.
 */ 
class HAR_TestLoadMultipleFiles extends HAR_TestCase
{
    public function testLoadFiles1()
    {
        print "\ntestLoadMulipleFiles.php";

        $viewer_base = $GLOBALS["harviewer_base"];
        $test_base = $GLOBALS["test_base"];

        // Put together URL that specifies multiple HAR files.
        $url = $viewer_base."?baseUrl=".$test_base."tests/hars/&";

        for ($i=1; $i<10; $i++)
            $url = $url."&path=".$i.".har";

        // Example of the result URL:
        // http://legoas/har/viewer/?
        // baseUrl=http://legoas/har/viewer/selenium/tests/hars/&
        // path=1.har&path=2.har&path=3.har&path=4.har&path=5.har&
        // path=6.har&path=7.har&path=8.har&path=9.har
        $this->open($url);

        // Wait for 10 sec to load all 9 HAR files.
        $this->waitForCondition(
            "selenium.browserbot.getCurrentWindow().document.querySelectorAll('.pageTable').length == 9",
            10000);

        // xxxHonza: remove the trailing space in the class attribute (domplate).
        $this->assertEquals(9, $this->getXpathCount("//div[@class='pageBar ']"));
        $this->assertElementContainsText("css=.PreviewTab.selected", "Preview");
    }
}
?>
