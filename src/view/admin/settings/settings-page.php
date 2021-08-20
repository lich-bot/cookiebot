<?php

use function cybot\cookiebot\addons\lib\asset_url;

/**
 * @var string $cbid
 * @var bool $is_ms
 * @var string $network_cbid
 * @var string $network_scrip_tag_uc_attr
 * @var string $network_scrip_tag_cd_attr
 * @var string $cookiebot_gdpr_url
 * @var string $cookiebot_logo
 * @var array $supported_languages
 * @var string $current_lang
 * @var bool $is_wp_consent_api_active
 * @var array $mDefault
 * @var array $m
 * @var string $cookie_blocking_mode
 */
?>
<div class="wrap">
	<h1><?php esc_html_e( 'Cookiebot Settings', 'cookiebot' ); ?></h1>
	<a href="https://www.cookiebot.com">
		<img src="<?php echo $cookiebot_logo; ?>"
			 style="float:right;margin-left:1em;">
	</a>
	<p>
		<?php
		printf(
			esc_html__(
				'Cookiebot enables your website to comply with current legislation in the EU on the use of cookies for user tracking and profiling. The EU ePrivacy Directive requires prior, informed consent of your site users, while the  %1$s %2$s.',
				'cookiebot'
			),
			sprintf(
				'<a href="%s" target="_blank">%s</a>',
				esc_url( $cookiebot_gdpr_url ),
				esc_html__( 'General Data Protection Regulation (GDPR)', 'cookiebot' )
			),
			esc_html__(
				' requires you to document each consent. At the same time you must be able to account for what user data you share with embedded third-party services on your website and where in the world the user data is sent.',
				'cookiebot'
			)
		);
		?>
	</p>
	<form method="post" action="options.php">
		<?php settings_fields( 'cookiebot' ); ?>
		<?php do_settings_sections( 'cookiebot' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Cookiebot ID', 'cookiebot' ); ?></th>
				<td>
					<input <?php echo ( $is_ms ) ? ' placeholder="' . esc_attr( $network_cbid ) . '"' : ''; ?>
							type="text" name="cookiebot-cbid"
							value="<?php echo esc_attr( $cbid ); ?>"
							style="width:300px"
					/>
					<p class="description">
						<?php esc_html_e( 'Need an ID?', 'cookiebot' ); ?>
						<a href="https://www.cookiebot.com/goto/signup" target="_blank">
							<?php
							esc_html_e(
								'Sign up for free on cookiebot.com',
								'cookiebot'
							);
							?>
						</a>
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php esc_html_e( 'Cookie-blocking mode', 'cookiebot' ); ?>
				</th>
				<td>
					<label>
						<input <?php checked( 'auto', $cookie_blocking_mode, true ); ?>
								type="radio"
								name="cookiebot-cookie-blocking-mode"
								value="auto"
						/>
						<?php esc_html_e( 'Automatic', 'cookiebot' ); ?>
					</label>
					&nbsp; &nbsp;
					<label>
						<input <?php checked( 'manual', $cookie_blocking_mode, true ); ?>
								type="radio"
								name="cookiebot-cookie-blocking-mode"
								value="manual"
						/>
						<?php esc_html_e( 'Manual', 'cookiebot' ); ?>
					</label>
					<p class="description">
						<?php esc_html_e( 'Automatic block cookies (except necessary) until the user has given their consent.', 'cookiebot' ); ?>
						<a href="https://support.cookiebot.com/hc/en-us/articles/360009063100-Automatic-Cookie-Blocking-How-does-it-work-"
						   target="_blank">
							<?php esc_html_e( 'Learn more', 'cookiebot' ); ?>
						</a>
					</p>
					<script>
						jQuery( document ).ready( function ( $ ) {
							var cookieBlockingMode = '<?php echo $cookie_blocking_mode; ?>'
							$( 'input[type=radio][name=cookiebot-cookie-blocking-mode]' ).on( 'change', function () {
								if ( this.value == 'auto' && cookieBlockingMode != this.value ) {
									$( '#cookiebot-setting-async, #cookiebot-setting-hide-popup' ).css( 'opacity', 0.4 )
									$( 'input[type=radio][name=cookiebot-script-tag-uc-attribute], input[name=cookiebot-nooutput]' ).prop( 'disabled', true )
								}
								if ( this.value == 'manual' && cookieBlockingMode != this.value ) {
									$( '#cookiebot-setting-async, #cookiebot-setting-hide-popup' ).css( 'opacity', 1 )
									$( 'input[type=radio][name=cookiebot-script-tag-uc-attribute], input[name=cookiebot-nooutput]' ).prop( 'disabled', false )
								}
								cookieBlockingMode = this.value
							} )
							if ( cookieBlockingMode == 'auto' ) {
								$( '#cookiebot-setting-async, #cookiebot-setting-hide-popup' ).css( 'opacity', 0.4 )
								$( 'input[type=radio][name=cookiebot-script-tag-uc-attribute], input[name=cookiebot-nooutput]' ).prop( 'disabled', true )
							}
						} )
					</script>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Cookiebot Language', 'cookiebot' ); ?></th>
				<td>
					<div>
						<select name="cookiebot-language" id="cookiebot-language">
							<option value=""><?php esc_html_e( 'Default (Autodetect)', 'cookiebot' ); ?></option>
							<option value="_wp"<?php echo ( $current_lang == '_wp' ) ? ' selected' : ''; ?>>
								<?php
								esc_html_e(
									'Use WordPress Language',
									'cookiebot'
								);
								?>
							</option>
							<?php
							foreach ( $supported_languages as $lang_code => $lang_name ) {
								echo '<option value="' . $lang_code . '"' . ( ( $current_lang === $lang_code ) ? ' selected' : '' ) . '>' . $lang_name . '</option>';
							}
							?>
						</select>
					</div>
					<div class="notice inline notice-warning notice-alt cookiebot-notice"
						 style="padding:12px;font-size:13px;display:inline-block;">
						<div style="<?php echo ( $current_lang === '' ) ? 'display:none;' : ''; ?>"
							 id="info_lang_specified">
							<?php esc_html_e( 'You need to add the language in the Cookiebot administration tool.', 'cookiebot' ); ?>
						</div>
						<div style="<?php echo ( $current_lang === '' ) ? '' : 'display:none;'; ?>"
							 id="info_lang_autodetect">
							<?php
							esc_html_e(
								'You need to add all languages that you want auto-detected in the Cookiebot administration tool.',
								'cookiebot'
							);
							?>
							<br/>
							<?php
							esc_html_e(
								'The auto-detect checkbox needs to be enabled in the Cookiebot administration tool.',
								'cookiebot'
							);
							?>
							<br/>
							<?php
							esc_html_e(
								'If the auto-detected language is not supported, Cookiebot will use the default language.',
								'cookiebot'
							);
							?>
						</div>
						<br/>

						<a href="#"
						   id="show_add_language_guide"><?php esc_html_e( 'Show guide to add languages', 'cookiebot' ); ?></a>
						&nbsp;
						<a href="https://support.cookiebot.com/hc/en-us/articles/360003793394-How-do-I-set-the-language-of-the-consent-banner-dialog-"
						   target="_blank">
							<?php esc_html_e( 'Read more here', 'cookiebot' ); ?>
						</a>

						<div id="add_language_guide" style="display:none;">
							<img src="<?php echo asset_url( 'img/guide_add_language.gif' ); ?>"
								 alt="Add language in Cookiebot administration tool"/>
							<br/>
							<a href="#"
							   id="hide_add_language_guide"><?php esc_html_e( 'Hide guide', 'cookiebot' ); ?></a>
						</div>
					</div>
					<script>
						jQuery( document ).ready( function ( $ ) {
							$( '#show_add_language_guide' ).on( 'click', function ( e ) {
								e.preventDefault()
								$( '#add_language_guide' ).slideDown()
								$( this ).hide()
							} )
							$( '#hide_add_language_guide' ).on( 'click', function ( e ) {
								e.preventDefault()
								$( '#add_language_guide' ).slideUp()
								$( '#show_add_language_guide' ).show()
							} )

							$( '#cookiebot-language' ).on( 'change', function () {
								if ( this.value === '' ) {
									$( '#info_lang_autodetect' ).show()
									$( '#info_lang_specified' ).hide()
								} else {
									$( '#info_lang_autodetect' ).hide()
									$( '#info_lang_specified' ).show()
								}
							} )
						} )
					</script>

				</td>
			</tr>
		</table>
		<script>
			jQuery( document ).ready( function ( $ ) {
				$( '.cookiebot_fieldset_header' ).on( 'click', function ( e ) {
					e.preventDefault()
					$( this ).next().slideToggle()
					$( this ).toggleClass( 'active' )
				} )
			} )
		</script>
		<style type="text/css">
			.cookiebot_fieldset_header {
				cursor: pointer;
			}

			.cookiebot_fieldset_header::after {
				content: "\f140";
				font: normal 24px/1 dashicons;
				position: relative;
				top: 5px;
			}

			.cookiebot_fieldset_header.active::after {
				content: "\f142";
			}
		</style>
		<h3 id="advanced_settings_link"
			class="cookiebot_fieldset_header"><?php esc_html_e( 'Advanced settings', 'cookiebot' ); ?></h3>
		<div id="advanced_settings" style="display:none;">
			<table class="form-table">
				<tr valign="top" id="cookiebot-setting-async">
					<th scope="row">
						<?php esc_html_e( 'Add async or defer attribute', 'cookiebot' ); ?>
						<br/><?php esc_html_e( 'Consent banner script tag', 'cookiebot' ); ?>
					</th>
					<td>
						<?php
						$cv       = get_option( 'cookiebot-script-tag-uc-attribute', 'async' );
						$disabled = false;
						if ( $is_ms && $network_scrip_tag_uc_attr !== 'custom' ) {
							$disabled = true;
							$cv       = $network_scrip_tag_uc_attr;
						}
						?>
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-uc-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="" <?php checked( '', $cv, true ); ?> />
							<i><?php esc_html_e( 'None', 'cookiebot' ); ?></i>
						</label>
						&nbsp; &nbsp;
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-uc-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="async" <?php checked( 'async', $cv, true ); ?> />
							async
						</label>
						&nbsp; &nbsp;
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-uc-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="defer" <?php checked( 'defer', $cv, true ); ?> />
							defer
						</label>
						<p class="description">
							<?php
							if ( $disabled ) {
								echo '<b>' . esc_html__(
									'Network setting applied. Please contact website administrator to change this setting.',
									'cookiebot'
								) . '</b><br />';
							}
							?>
							<?php esc_html_e( 'Add async or defer attribute to Cookiebot script tag. Default: async', 'cookiebot' ); ?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<?php esc_html_e( 'Add async or defer attribute', 'cookiebot' ); ?>
						<br/><?php esc_html_e( 'Cookie declaration script tag', 'cookiebot' ); ?>
					</th>
					<td>
						<?php
						$cv       = get_option( 'cookiebot-script-tag-cd-attribute', 'async' );
						$disabled = false;
						if ( $is_ms && $network_scrip_tag_cd_attr !== 'custom' ) {
							$disabled = true;
							$cv       = $network_scrip_tag_cd_attr;
						}
						?>
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-cd-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="" <?php checked( '', $cv, true ); ?> />
							<i><?php esc_html_e( 'None', 'cookiebot' ); ?></i>
						</label>
						&nbsp; &nbsp;
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-cd-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="async" <?php checked( 'async', $cv, true ); ?> />
							async
						</label>
						&nbsp; &nbsp;
						<label>
							<input type="radio"
								   name="cookiebot-script-tag-cd-attribute"<?php echo ( $disabled ) ? ' disabled' : ''; ?>
								   value="defer" <?php checked( 'defer', $cv, true ); ?> />
							defer
						</label>
						<p class="description">
							<?php
							if ( $disabled ) {
								echo '<b>' . esc_html__(
									'Network setting applied. Please contact website administrator to change this setting.',
									'cookiebot'
								) . '</b><br />';
							}
							?>
							<?php esc_html_e( 'Add async or defer attribute to Cookiebot script tag. Default: async', 'cookiebot' ); ?>
						</p>
					</td>
				</tr>
				<?php
				if ( ! is_multisite() ) {
					?>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Auto-update Cookiebot', 'cookiebot' ); ?></th>
						<td>
							<input type="checkbox" name="cookiebot-autoupdate" value="1"
								<?php
								checked(
									1,
									get_option( 'cookiebot-autoupdate', false ),
									true
								);
								?>
							/>
							<p class="description">
								<?php esc_html_e( 'Automatic update your Cookiebot plugin when new releases becomes available.', 'cookiebot' ); ?>
							</p>
						</td>
					</tr>
					<?php
				}
				?>
				<tr valign="top" id="cookiebot-setting-hide-popup">
					<th scope="row"><?php esc_html_e( 'Hide Cookie Popup', 'cookiebot' ); ?></th>
					<td>
						<?php
						$disabled = false;
						if ( $is_ms && get_site_option( 'cookiebot-nooutput', false ) ) {
							$disabled = true;
							echo '<input type="checkbox" checked disabled />';
						} else {
							?>
							<input type="checkbox" name="cookiebot-nooutput" value="1"
								<?php
								checked(
									1,
									get_option( 'cookiebot-nooutput', false ),
									true
								);
								?>
							/>
							<?php
						}
						?>
						<p class="description">
							<?php
							if ( $disabled ) {
								echo '<b>' . esc_html__(
									'Network setting applied. Please contact website administrator to change this setting.',
									'cookiebot'
								) . '</b><br />';
							}
							?>
							<b>
								<?php
								esc_html_e(
									'This checkbox will remove the cookie consent banner from your website. The <i>[cookie_declaration]</i> shortcode will still be available.',
									'cookiebot'
								);
								?>
							</b><br/>
							<?php
							esc_html_e(
								'If you are using Google Tag Manager (or equal), you need to add the Cookiebot script in your Tag Manager.',
								'cookiebot'
							);
							?>
							<br/>
							<a href="https://support.cookiebot.com/hc/en-us/articles/360003793854-Google-Tag-Manager-deployment"
							   target="_blank">
								<?php esc_html_e( 'See a detailed guide here', 'cookiebot' ); ?>
							</a>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Disable Cookiebot in WP Admin', 'cookiebot' ); ?></th>
					<td>
						<?php
						$disabled = false;
						if ( $is_ms && get_site_option( 'cookiebot-nooutput-admin', false ) ) {
							echo '<input type="checkbox" checked disabled />';
							$disabled = true;
						} else {
							?>
							<input type="checkbox" name="cookiebot-nooutput-admin" value="1"
								<?php
								checked(
									1,
									get_option( 'cookiebot-nooutput-admin', false ),
									true
								);
								?>
							/>
							<?php
						}
						?>
						<p class="description">
							<?php
							if ( $disabled ) {
								echo '<b>' . __( 'Network setting applied. Please contact website administrator to change this setting.' ) . '</b><br />';
							}
							?>
							<b><?php esc_html_e( 'This checkbox will disable Cookiebot in the WordPress Admin area.', 'cookiebot' ); ?></b>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Enable Cookiebot on front end while logged in', 'cookiebot' ); ?></th>
					<td>
						<?php
						$disabled = false;
						if ( $is_ms && get_site_option( 'cookiebot-output-logged-in', false ) ) {
							echo '<input type="checkbox" checked disabled />';
							$disabled = true;
						} else {
							?>
							<input type="checkbox" name="cookiebot-output-logged-in" value="1"
								<?php
								checked(
									1,
									get_option( 'cookiebot-output-logged-in', false ),
									true
								);
								?>
							/>
							<?php
						}
						?>
						<p class="description">
							<?php
							if ( $disabled ) {
								echo '<b>' . esc_html__( 'Network setting applied. Please contact website administrator to change this setting.' ) . '</b><br />';
							}
							?>
							<b><?php esc_html_e( 'This checkbox will enable Cookiebot on front end while you\'re logged in', 'cookiebot' ); ?></b>
						</p>
					</td>
				</tr>
			</table>
		</div>
		<?php if ( $is_wp_consent_api_active ) { ?>
			<h3 id="consent_level_api_settings" class="cookiebot_fieldset_header">
				<?php
				esc_html_e(
					'Consent Level API Settings',
					'cookiebot'
				);
				?>
			</h3>
			<div id="consent_level_api_settings" style="display:none;">
				<p>
					<?php
					esc_html_e(
						'WP Consent Level API and Cookiebot categorise cookies a bit different. The default settings should fit mosts needs - but if you need to change the mapping you are able to do it below.',
						'cookiebot'
					);
					?>
				</p>

				<?php
				$consentTypes = array( 'preferences', 'statistics', 'marketing' );
				$states       = array_reduce(
					$consentTypes,
					function ( $t, $v ) {
						$newt = array();
						if ( empty( $t ) ) {
							$newt = array(
								array( $v => true ),
								array( $v => false ),
							);
						} else {
							foreach ( $t as $item ) {
								$newt[] = array_merge( $item, array( $v => true ) );
								$newt[] = array_merge( $item, array( $v => false ) );
							}
						}

						return $newt;
					},
					array()
				);

				?>


				<table class="widefat striped consent_mapping_table">
					<thead>
					<tr>
						<th><?php esc_html_e( 'Cookiebot categories', 'cookiebot' ); ?></th>
						<th class="consent_mapping"><?php esc_html_e( 'WP Consent Level categories', 'cookiebot' ); ?></th>
					</tr>
					</thead>
					<?php
					foreach ( $states as $state ) {

						$key   = array();
						$key[] = 'n=1';
						$key[] = 'p=' . ( $state['preferences'] ? '1' : '0' );
						$key[] = 's=' . ( $state['statistics'] ? '1' : '0' );
						$key[] = 'm=' . ( $state['marketing'] ? '1' : '0' );
						$key   = implode( ';', $key );
						?>
						<tr valign="top">
							<td>
								<div class="cb_consent">
												<span class="forceconsent">
													<?php esc_html_e( 'Necessary', 'cookiebot' ); ?>
												</span>
									<span class="<?php echo( $state['preferences'] ? 'consent' : 'noconsent' ); ?>">
													<?php esc_html_e( 'Preferences', 'cookiebot' ); ?>
												</span>
									<span class="<?php echo( $state['statistics'] ? 'consent' : 'noconsent' ); ?>">
													<?php esc_html_e( 'Statistics', 'cookiebot' ); ?>
												</span>
									<span class="<?php echo( $state['marketing'] ? 'consent' : 'noconsent' ); ?>">
													<?php esc_html_e( 'Marketing', 'cookiebot' ); ?>
												</span>
								</div>
							</td>
							<td>
								<div class="consent_mapping">
									<label><input type="checkbox"
												  name="cookiebot-consent-mapping[<?php echo $key; ?>][functional]"
												  data-default-value="1" value="1" checked disabled
										> <?php esc_html_e( 'Functional', 'cookiebot' ); ?> </label>
									<label><input type="checkbox"
												  name="cookiebot-consent-mapping[<?php echo $key; ?>][preferences]"
												  data-default-value="<?php echo $mDefault[ $key ]['preferences']; ?>"
												  value="1"
											<?php
											if ( $m[ $key ]['preferences'] ) {
												echo 'checked';
											}
											?>
										> <?php esc_html_e( 'Preferences', 'cookiebot' ); ?> </label>
									<label><input type="checkbox"
												  name="cookiebot-consent-mapping[<?php echo $key; ?>][statistics]"
												  data-default-value="<?php echo $mDefault[ $key ]['statistics']; ?>"
												  value="1"
											<?php
											if ( $m[ $key ]['statistics'] ) {
												echo 'checked';
											}
											?>
										> <?php esc_html_e( 'Statistics', 'cookiebot' ); ?> </label>
									<label><input type="checkbox"
												  name="cookiebot-consent-mapping[<?php echo $key; ?>][statistics-anonymous]"
												  data-default-value="<?php echo $mDefault[ $key ]['statistics-anonymous']; ?>"
												  value="1"
											<?php
											if ( $m[ $key ]['statistics-anonymous'] ) {
												echo 'checked';
											}
											?>
										> <?php esc_html_e( 'Statistics Anonymous', 'cookiebot' ); ?>
									</label>
									<label><input type="checkbox"
												  name="cookiebot-consent-mapping[<?php echo $key; ?>][marketing]"
												  data-default-value="<?php echo $mDefault[ $key ]['marketing']; ?>"
												  value="1"
											<?php
											if ( $m[ $key ]['marketing'] ) {
												echo 'checked';
											}
											?>
										> <?php esc_html_e( 'Marketing', 'cookiebot' ); ?></label>
								</div>
							</td>
						</tr>
						<?php
					}
					?>
					<tfoot>
					<tr>
						<td colspan="2" style="text-align:right;">
							<button class="button" onclick="return resetConsentMapping();">
								<?php
								esc_html_e(
									'Reset to default mapping',
									'cookiebot'
								);
								?>
							</button>
						</td>
					</tr>
					</tfoot>
				</table>
				<script>
					function resetConsentMapping() {
						if ( confirm( 'Are you sure you want to reset to default consent mapping?' ) ) {
							jQuery( '.consent_mapping_table input[type=checkbox]' ).each( function () {
								if ( !this.disabled ) {
									this.checked = ( jQuery( this ).data( 'default-value' ) == '1' ) ? true : false
								}
							} )
						}
						return false
					}
				</script>
			</div>
		<?php } ?>
		<?php submit_button(); ?>
	</form>
</div>