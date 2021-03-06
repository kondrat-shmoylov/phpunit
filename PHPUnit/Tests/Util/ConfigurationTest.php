<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.3.0
 */

require_once 'PHPUnit/Framework/TestCase.php';

require_once 'PHPUnit/Util/Configuration.php';

/**
 *
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.3.0
 */
class Util_ConfigurationTest extends PHPUnit_Framework_TestCase
{
    protected $configuration;

    protected function setUp()
    {
        $this->configuration = PHPUnit_Util_Configuration::getInstance(
          dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'configuration.xml'
        );
    }

    public function testGetFilterConfiguration()
    {
        $this->assertEquals(
          array (
            'blacklist' =>
            array (
              'include' =>
              array (
                'directory' =>
                array (
                  0 =>
                  array (
                    'path' => '/path/to/files',
                    'prefix' => '',
                    'suffix' => '.php',
                    'group' => 'DEFAULT'
                  ),
                ),
                'file' =>
                array (
                  0 => '/path/to/file',
                ),
              ),
              'exclude' =>
              array (
                'directory' =>
                array (
                  0 =>
                  array (
                    'path' => '/path/to/files',
                    'prefix' => '',
                    'suffix' => '.php',
                    'group' => 'DEFAULT'
                  ),
                ),
                'file' =>
                array (
                  0 => '/path/to/file',
                ),
              ),
            ),
            'whitelist' =>
            array (
              'addUncoveredFilesFromWhitelist' => TRUE,
              'include' =>
              array (
                'directory' =>
                array (
                  0 =>
                  array (
                    'path' => '/path/to/files',
                    'prefix' => '',
                    'suffix' => '.php',
                    'group' => 'DEFAULT'
                  ),
                ),
                'file' =>
                array (
                  0 => '/path/to/file',
                ),
              ),
              'exclude' =>
              array (
                'directory' =>
                array (
                  0 =>
                  array (
                    'path' => '/path/to/files',
                    'prefix' => '',
                    'suffix' => '.php',
                    'group' => 'DEFAULT'
                  ),
                ),
                'file' =>
                array (
                  0 => '/path/to/file',
                ),
              ),
            ),
          ),
          $this->configuration->getFilterConfiguration()
        );
    }

    public function testGetGroupConfiguration()
    {
        $this->assertEquals(
          array (
            'include' =>
            array (
              0 => 'name',
            ),
            'exclude' =>
            array (
              0 => 'name',
            ),
          ),
          $this->configuration->getGroupConfiguration()
        );
    }

    public function testGetListenerConfiguration()
    {
        $this->assertEquals(
          array (
            0 =>
            array (
              'class' => 'MyListener',
              'file' => '/optional/path/to/MyListener.php',
              'arguments' =>
              array (
                0 =>
                array (
                  0 => 'Sebastian',
                ),
                1 => 22,
                2 => 'April',
                3 => 19.78,
                4 => NULL,
                5 => new stdClass,
              ),
            ),
          ),
          $this->configuration->getListenerConfiguration()
        );
    }

    public function testGetLoggingConfiguration()
    {
        $this->assertEquals(
          array (
            'title' => 'My Project',
            'charset' => 'UTF-8',
            'lowUpperBound' => '35',
            'highLowerBound' => '70',
            'yui' => TRUE,
            'highlight' => FALSE,
            'coverage-html' => '/tmp/report',
            'coverage-clover' => '/tmp/clover.xml',
            'json' => '/tmp/logfile.json',
            'plain' => '/tmp/logfile.txt',
            'tap' => '/tmp/logfile.tap',
            'logIncompleteSkipped' => FALSE,
            'junit' => '/tmp/logfile.xml',
            'story-html' => '/tmp/story.html',
            'story-text' => '/tmp/story.txt',
            'testdox-html' => '/tmp/testdox.html',
            'testdox-text' => '/tmp/testdox.txt',
          ),
          $this->configuration->getLoggingConfiguration()
        );
    }

    public function testGetPHPConfiguration()
    {
        $this->assertEquals(
          array (
            'include_path' => '.',
            'ini' =>
            array (
              'foo' => 'bar',
            ),
            'const' =>
            array (
              'foo' => 'bar',
            ),
            'var' =>
            array (
              'foo' => 'bar',
            ),
          ),
          $this->configuration->getPHPConfiguration()
        );
    }

    public function testGetPHPUnitConfiguration()
    {
        $this->assertEquals(
          array (
            'backupGlobals' => TRUE,
            'backupStaticAttributes' => FALSE,
            'bootstrap' => '/path/to/bootstrap.php',
            'colors' => FALSE,
            'convertErrorsToExceptions' => TRUE,
            'convertNoticesToExceptions' => TRUE,
            'convertWarningsToExceptions' => TRUE,
            'stopOnFailure' => FALSE,
            'syntaxCheck' => FALSE,
            'testSuiteLoaderClass' => 'PHPUnit_Runner_StandardTestSuiteLoader',
            'verbose' => FALSE
          ),
          $this->configuration->getPHPUnitConfiguration()
        );
    }

    public function testGetSeleniumBrowserConfiguration()
    {
        $this->assertEquals(
          array (
            0 =>
            array (
              'name' => 'Firefox on Linux',
              'browser' => '*firefox /usr/lib/firefox/firefox-bin',
              'host' => 'my.linux.box',
              'port' => 4444,
              'timeout' => 30000,
            ),
          ),
          $this->configuration->getSeleniumBrowserConfiguration()
        );
    }
}
