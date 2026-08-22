<?php
/**
 * Tests for Simple Plyr.
 */
class Simple_Plyr_Test extends WP_UnitTestCase {

	public function test_shortcode_registered() {
		$this->assertTrue( shortcode_exists( 'plyr' ) );
	}

	public function test_shortcode_renders_video() {
		$html = do_shortcode( '[plyr url="https://cdn.example.com/a.mp4" poster="https://cdn.example.com/p.jpg"]' );
		$this->assertStringContainsString( "<video poster='https://cdn.example.com/p.jpg' controls>", $html );
		$this->assertStringContainsString( "src='https://cdn.example.com/a.mp4'", $html );
		$this->assertStringContainsString( 'plyr.setup();', $html );
	}

	public function test_shortcode_defaults() {
		$html = do_shortcode( '[plyr]' );
		$this->assertStringContainsString( '/path/to/video.mp4', $html );
		$this->assertStringContainsString( '/path/to/poster.jpg', $html );
	}

	public function test_assets_are_enqueued() {
		plyr_assets();
		$this->assertTrue( wp_style_is( 'plyr-style', 'enqueued' ) );
		$this->assertTrue( wp_script_is( 'plyr-script', 'enqueued' ) );
	}
}
