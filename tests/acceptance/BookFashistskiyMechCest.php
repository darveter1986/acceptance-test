<?php


class Sigma1011Cest
{
    const TEST_URL = 'list/q-sigma-10.11/?search%5Bfilter_float_price%3Ato%5D=500';
    const MAIL_TO = 'bondar@atwix.com';
    const MAIL_TEXT = 'Hello!';

    private function getScreenShotFile()
    {
        return implode(DIRECTORY_SEPARATOR, array(getcwd(), 'tests', '_output', get_class($this) . '.tryToTest.fail.png'));
    }

    private function getMailSubjekt()
    {
        return get_class($this);
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage(self::TEST_URL);
        $I->see('Ничего не найдено');
    }

    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function _failed(AcceptanceTester $I)
    {
        // send email to myself here
        $command = 'echo "%s" | mail -s "%s" -A %s %s';
        $command = sprintf($command, self::MAIL_TEXT, $this->getMailSubjekt(), $this->getScreenShotFile(), self::MAIL_TO);
        $I->runShellCommand($command);
    }
}
