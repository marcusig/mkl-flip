<?php
/**
* Plugin Name: Flippin countdown
* Description: A countdown plugin using pqina/flip
* Author: mklacroix
* Version: 1.0.0
*
* Copyright: © 2020 mklacroix (email : contact@mklacroix.com)
* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
define( 'MKL_FLIP_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

class MKL_Flip {
	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function init() {
		add_shortcode( 'mkl_flip', [ $this, 'render_shortcode' ] );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'pqina/flip', MKL_FLIP_URL . 'node_modules/@pqina/flip/dist/flip.min.css', [], '1.8.0' );
		wp_enqueue_style( 'mkl-tick', MKL_FLIP_URL . 'mkl-tick.css', [ 'pqina/flip' ], '1.0.0' );
		wp_enqueue_script( 'pqina/flip', MKL_FLIP_URL . 'node_modules/@pqina/flip/dist/flip.min.js', [], '1.8.0', true );
		wp_enqueue_script( 'mkl-tick', MKL_FLIP_URL . 'mkl-tick.js', [ 'pqina/flip', 'jquery' ], '1.0.0', true );
	}

	public function render_shortcode( $attrs ) {
		static $count = 1;
		$default = array(
			'type'  => 'countdown',
			'default_value' => '',
			'date'  => '',
			'id' => ''
		);

		$attrs = wp_parse_args( $attrs, $default );
		// $id = 'mkl-flippin-' . $count;
		ob_start();
		switch( $attrs[ 'type' ] ) {
			case 'countdown':
				if ( ! $attrs[ 'date' ] ) {
					echo 'Invalid date provided';
					break;
				}
				$this->_output_countdown_markup( $attrs[ 'date' ], $attrs );
				break;
			case 'simple':
				$this->_output_simple_markup( $attrs[ 'value' ], $attrs );
				break;
		}
		?>
		<?php 
		$count++;
		return ob_get_clean();
	}

	private function _output_countdown_markup( $date, $attrs ) {
		$id = $attrs['id'];
		?>
		<div class="tick"
			data-did-init="mkl_tick_countdown"
			data-date="<?php echo esc_attr( $date ); ?>"
			<?php echo $id ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
			>

			<div data-repeat="true"
				data-layout="horizontal center fit"
				data-transform="preset(d, h, m, s) -> delay">

				<div class="tick-group">

					<div data-key="value"
						data-repeat="true"
						data-transform="pad(00) -> split -> delay">

						<span data-view="flip"></span>

					</div>

					<span data-key="label"
						data-view="text"
						class="tick-label"></span>

				</div>

			</div>

		</div>
		<?php
	}

	private function _output_simple_markup( $value, $attrs ) {
		$init_value = str_repeat( '0', strlen( (string) $value ) );
		$id = $attrs['id'];
		?>
			<div class="tick"
				data-value="<?php echo esc_attr( $init_value );?>"
				data-set-value="<?php echo esc_attr( $value );?>"
				data-did-init="mkl_simple_tick_setup"
				<?php echo $id ? 'id="' . esc_attr( $id ) . '"' : ''; ?>
				>
				<!-- 
				The aria-hidden attribute below hides 
				the tick content from screenreaders
				-->
				<span data-layout="horizontal center" data-repeat="true" data-transform="tween(1s, ease-out-bounce) -> round -> split -> delay(rtl, 100, 150)">

					<span data-view="flip"></span>

				</span>

			</div>		
		<?php
	}
}

new MKL_Flip();
