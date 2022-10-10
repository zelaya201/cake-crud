<?php
declare(strict_types=1);

namespace Avolle\FontAwesome\Test\TestCase\View\Helper;

use Avolle\FontAwesome\View\Helper\FontAweHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\FontAweHelper Test Case
 */
class FontAweHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Avolle\FontAwesome\View\Helper\FontAweHelper
     */
    protected FontAweHelper $FontAwe;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->FontAwe = new FontAweHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->FontAwe);

        parent::tearDown();
    }

    /**
     * Test solid method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::solid()
     */
    public function testSolid(): void
    {
        $expected = '<i class="fas fa-receipt"></i>';
        $actual = $this->FontAwe->solid('receipt');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test solid method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::solid()
     */
    public function testSolidTitle(): void
    {
        $expected = '<i class="fas fa-receipt"></i> Some title';
        $actual = $this->FontAwe->solid('receipt', 'Some title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test regular method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::regular()
     */
    public function testRegular(): void
    {
        $expected = '<i class="far fa-receipt"></i>';
        $actual = $this->FontAwe->regular('receipt');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test light method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::light()
     */
    public function testLight(): void
    {
        $expected = '<i class="fal fa-receipt"></i>';
        $actual = $this->FontAwe->light('receipt');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test duo method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::duo()
     */
    public function testDuo(): void
    {
        $expected = '<i class="fad fa-receipt"></i>';
        $actual = $this->FontAwe->duo('receipt');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test solidLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::solidLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testSolidLink(): void
    {
        $expected = '<a href="/link"><i class="fas fa-receipt"></i> Some Title</a>';
        $actual = $this->FontAwe->solidLink('receipt', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test regularLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::regularLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testRegularLink(): void
    {
        $expected = '<a href="/link"><i class="far fa-receipt"></i> Some Title</a>';
        $actual = $this->FontAwe->regularLink('receipt', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test lightLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::lightLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testLightLink(): void
    {
        $expected = '<a href="/link"><i class="fal fa-receipt"></i> Some Title</a>';
        $actual = $this->FontAwe->lightLink('receipt', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test duoLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::duoLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testDuoLink(): void
    {
        $expected = '<a href="/link"><i class="fad fa-receipt"></i> Some Title</a>';
        $actual = $this->FontAwe->duoLink('receipt', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test brandLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::brandLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testBrandLink(): void
    {
        $expected = '<a href="/link"><i class="fab fa-github"></i> Some Title</a>';
        $actual = $this->FontAwe->brandLink('github', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test thinLink method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::thinLink()
     * @noinspection HtmlUnknownTarget
     */
    public function testThinLink(): void
    {
        $expected = '<a href="/link"><i class="fat fa-receipt"></i> Some Title</a>';
        $actual = $this->FontAwe->thinLink('receipt', '/link', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test link method
     * Empty title
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::link()
     * @noinspection HtmlUnknownTarget
     * @noinspection PhpRedundantOptionalArgumentInspection
     */
    public function testLinkTitleEmpty(): void
    {
        $expected = '<a href="/link"><i class="fad fa-receipt"></i></a>';
        $actual = $this->FontAwe->duoLink('receipt', '/link');
        $this->assertEquals($expected, $actual);

        $actual = $this->FontAwe->duoLink('receipt', '/link', null);
        $this->assertEquals($expected, $actual);

        $actual = $this->FontAwe->duoLink('receipt', '/link', '');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test link method
     * Escape option true
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::link()
     * @noinspection HtmlUnknownTarget
     */
    public function testLinkEscapeTrue(): void
    {
        $expected = '<a href="/link">&lt;i class=&quot;fad fa-receipt&quot;&gt;&lt;/i&gt; Some Title</a>';
        $actual = $this->FontAwe->duoLink('receipt', '/link', 'Some Title', ['escape' => true]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test link method
     * Icon options are passed onto icon tag
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::link()
     * @noinspection HtmlUnknownTarget
     */
    public function testLinkIconOptions(): void
    {
        $expected = '<a href="/link"><i class="fad fa-receipt other-class" title="Some title"></i> Some Title</a>';
        $actual = $this->FontAwe->duoLink('receipt', '/link', 'Some Title', [
            'icon' => ['class' => 'other-class', 'title' => 'Some title'],
        ]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test icon method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::icon()
     */
    public function testIcon(): void
    {
        $expected = '<i class="fad fa-receipt"></i> Some Title';
        $actual = $this->FontAwe->icon(FontAweHelper::DUO, 'receipt', 'Some Title');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test icon method
     * No title
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::icon()
     */
    public function testIconNoTitle(): void
    {
        $expected = '<i class="fas fa-receipt"></i>';
        $actual = $this->FontAwe->icon(FontAweHelper::SOLID, 'receipt');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test icon method
     * Various escape options
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::icon()
     */
    public function testIconEscapeOptions(): void
    {
        // Escape true
        $expected = '<i class="fas fa-receipt"></i> &amp;oslash;';
        $actual = $this->FontAwe->icon(FontAweHelper::SOLID, 'receipt', '&oslash;', ['escape' => true]);
        $this->assertEquals($expected, $actual);

        // Escape false
        $expected = '<i class="fas fa-receipt"></i> &oslash;';
        $actual = $this->FontAwe->icon(FontAweHelper::SOLID, 'receipt', '&oslash;', ['escape' => false]);
        $this->assertEquals($expected, $actual);

        // Custom escape
        $expected = '<i class="fas fa-receipt"></i> &amp;oslash;';
        $actual = $this->FontAwe->icon(FontAweHelper::SOLID, 'receipt', '&oslash;', ['escapeTitle' => 'ISO-8859-1']);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test script method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::script()
     * @noinspection HtmlUnknownTarget
     * @noinspection JSUnresolvedLibraryURL
     */
    public function testScript(): void
    {
        $expected = '<script src="/js/all.js"></script>';
        $actual = $this->FontAwe->script();
        $this->assertEquals($expected, $actual);
        // With script param
        $expected = '<script src="/js/font-awesome.js"></script>';
        $actual = $this->FontAwe->script('font-awesome');
        $this->assertEquals($expected, $actual);
        // With script and path param
        $expected = '<script src="/js/font-awesome/all.js"></script>';
        $actual = $this->FontAwe->script('all', 'font-awesome/');
        $this->assertEquals($expected, $actual);
        // With path param - appending default js path
        $expected = '<script src="/js/fontawesome/all.js"></script>';
        $actual = $this->FontAwe->script(null, 'fontawesome/');
        $this->assertEquals($expected, $actual);
        // With path param - overriding default js path
        $expected = '<script src="/fontawesome/all.js"></script>';
        $actual = $this->FontAwe->script(null, '/fontawesome/');
        $this->assertEquals($expected, $actual);
        // With absolute script
        $expected = '<script src="https://test-site.com/js/fontawesome/all.js"></script>';
        $actual = $this->FontAwe->script('https://test-site.com/js/fontawesome/all.js');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test scriptKit method
     *
     * @return void
     * @uses \Avolle\FontAwesome\View\Helper\FontAweHelper::scriptKit()
     * @noinspection JSUnresolvedLibraryURL
     */
    public function testScriptKit(): void
    {
        $expected = '<script src="https://kit.fontawesome.com/kit-identifier.js" crossorigin="anonymous"></script>';
        $actual = $this->FontAwe->scriptKit('kit-identifier');
        $this->assertEquals($expected, $actual);
    }
}
