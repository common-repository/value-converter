<?php
/*
 * Plugin Name: converter
 * Description: converter for units(kilograms-pounds, and else)
 * Author: Light4210
 * Version: 1.00
 * Plugin URL: htpp://wordpress.org/plugins/converter
 * Author URI: https://www.bazar.club/
*/

/**
 * Создаем страницу настроек 
 */

function conv_true_include_myscript() {
	wp_enqueue_script( 'my_custom_script', plugin_dir_url('js/script.js',__FILE__ ));
	wp_enqueue_script('my_custom_script');
}


$true_page = 'myparameters.php'; // это часть URL страницы, рекомендую использовать строковое значение, т.к. в данном случае не будет зависимости от того, в какой файл вы всё это вставите
/*
 * Функция, добавляющая страницу в пункт меню Настройки
 */
function conv_options()
{
	global $true_page;
	add_options_page('converter', 'converter', 'manage_options', $true_page, 'conv_option_page');
}
add_action('admin_menu', 'conv_options');
/**
 * Возвратная функция (Callback)
 */
function conv_option_page()
{
	global $true_page;
?><div class="wrap">
		<h2>converter settings</h2>
		<form method="post" enctype="multipart/form-data" action="options.php">
			<?php
			echo ("Use this shortcode to call converter: [converter]");
			settings_fields('conv_options'); // меняем под себя только здесь (название настроек)
			do_settings_sections($true_page);
			?>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div><?php
		}
		/*
 * Регистрируем настройки
 * Мои настройки будут храниться в базе под названием conv_options (это также видно в предыдущей функции)
 */
		function conv_option_settings()
		{
			global $true_page;
			// Присваиваем функцию валидации ( conv_validate_settings() ). Вы найдете её ниже
			register_setting('conv_options', 'conv_options', 'conv_validate_settings'); // conv_options
			// Добавляем секцию
			add_settings_section('true_section_1', 'Button setting', '', $true_page);
			// Создадим текстовое поле в первой секции
			$true_field_params = array(
				'type'      => 'text', // тип
				'id'        => 'buttonText',
				'desc'      => 'Button text', // описание
				'desc'      => 'buttonText' // позволяет сделать название настройки лейблом (если не понимаете, что это, можете не использовать), по идее должно быть одинаковым с параметром id
			);
			add_settings_field('my_text_field', 'Button text value', 'conv_option_display_settings', $true_page, 'true_section_1', $true_field_params);
			// Добавляем вторую секцию настроек
			add_settings_section('true_section_2', 'Left list of units', '', $true_page);
			// Создадим чекбокс
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'kilograms1',
				'desc'      => ''
			);
			add_settings_field('kilograms1_field', 'Kilograms', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'pounds1',
				'desc'      => ''
			);
			add_settings_field('pounds1_field', 'Pounds', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'meters1',
				'desc'      => ''
			);
			add_settings_field('meters1', 'Meters', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'centimeters1',
				'desc'      => ''
			);
			add_settings_field('centimeters1_field', 'Centimeters', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'yards1',
				'desc'      => ''
			);
			add_settings_field('yards1_field', 'Yards', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'inch1',
				'desc'      => ''
			);
			add_settings_field('inch1_field', 'Inch', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'C1',
				'desc'      => ''
			);
			add_settings_field('C1_field', 'C', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'F1',
				'desc'      => ''
			);
			add_settings_field('F1_field', 'F', 'conv_option_display_settings', $true_page, 'true_section_2', $true_field_params);

			add_settings_section('true_section_3', 'Right list of units', '', $true_page);
			// Создадим чекбокс
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'kilograms2',
				'desc'      => ''
			);
			add_settings_field('kilograms2_field', 'Kilograms', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'pounds2',
				'desc'      => ''
			);
			add_settings_field('pounds2_field', 'Pounds', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'meters2',
				'desc'      => ''
			);
			add_settings_field('meters2_field', 'Meters', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'centimeters2',
				'desc'      => ''
			);
			add_settings_field('centimeters2_field', 'Centimeters', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'yards2',
				'desc'      => ''
			);
			add_settings_field('yards2_field', 'Yards', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'inch2',
				'desc'      => ''
			);
			add_settings_field('inch2_field', 'Inch', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'C2',
				'desc'      => ''
			);
			add_settings_field('C2_field', 'C', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
			$true_field_params = array(
				'type'      => 'checkbox',
				'id'        => 'F2',
				'desc'      => ''
			);
			add_settings_field('F2_field', 'F', 'conv_option_display_settings', $true_page, 'true_section_3', $true_field_params);
		}
		add_action('admin_init', 'conv_option_settings');
		/*
 * Функция отображения полей ввода
 * Здесь задаётся HTML и PHP, выводящий поля
 */
		function conv_option_display_settings($args)
		{
			extract($args);
			$option_name = 'conv_options';
			$o = get_option($option_name);
			switch ($type) {
				case 'text':
					$o[$id] = esc_attr(stripslashes($o[$id]));
					echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";
					echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
					break;
				case 'textarea':
					$o[$id] = esc_attr(stripslashes($o[$id]));
					echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";
					echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
					break;
				case 'checkbox':
					$checked = ($o[$id] == 'on') ? " checked='checked'" :  '';
					echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";
					echo ($desc != '') ? $desc : "";
					echo "</label>";
					break;
				case 'select':
					echo "<select id='$id' name='" . $option_name . "[$id]'>";
					foreach ($vals as $v => $l) {
						$selected = ($o[$id] == $v) ? "selected='selected'" : '';
						echo "<option value='$v' $selected>$l</option>";
					}
					echo ($desc != '') ? $desc : "";
					echo "</select>";
					break;
				case 'radio':
					echo "<fieldset>";
					foreach ($vals as $v => $l) {
						$checked = ($o[$id] == $v) ? "checked='checked'" : '';
						echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
					}
					echo "</fieldset>";
					break;
			}
		}
		/*
 * Функция проверки правильности вводимых полей
 */
		function conv_validate_settings($input)
		{
			foreach ($input as $k => $v) {
				$valid_input[$k] = trim($v);
			}
			return $valid_input;
		}
		function conv_converter()
		{
			$someNum1 = sanitize_text_field( $_POST['inputNum1']);
			$opt1 = sanitize_text_field( $_POST['select_options1']);
			$opt2 = sanitize_text_field( $_POST['select_options2']);

			if( !empty($someNum1)){
			///////////////////////////Weight//////////////////////////////
			if ($opt1 == "kilograms") {
				if ($opt2 == "pounds") {
					echo (round($someNum1 * 2.20462, 4));
				} else if ($opt2 == "kilograms") {
					echo ($someNum1);
				}
			} else if ($opt1 == "pounds") {
				if ($opt2 == "kilograms") {
					echo (round($someNum1 / 2.20462, 4));
				} else if ($opt1 == "pounds") {
					echo ($someNum1);
				}
			}
			///////////////////////////Lenght//////////////////////////////
			else if ($opt1 == "meters") {
				if ($opt2 == "centimeters") {
					echo (round($someNum1 * 100, 4));
				} else if ($opt2 == "yards") {
					echo (round($someNum1 * 1.094, 4));
				} else if ($opt2 == "inch") {
					echo (round($someNum1 * 39.37, 4));
				} else if ($opt2 == "meters") {
					echo ($someNum1);
				}
			} else if ($opt1 == "centimeters") {
				if ($opt2 == "meters") {
					echo (round($someNum1 / 100, 4));
				} else if ($opt2 == "yards") {
					echo (round($someNum1 / 91.44, 4));
				} else if ($opt2 == "inch") {
					echo (round($someNum1 / 2.54, 4));
				} else if ($opt2 == "centimeters") {
					echo ($someNum1);
				}
			} else if ($opt1 == "yards") {
				if ($opt2 == "meters") {
					echo (round($someNum1 / 1.094, 4));
				} else if ($opt2 == "centimeters") {
					echo (round($someNum1 * 91.44, 4));
				} else if ($opt2 == "inch") {
					echo (round($someNum1 * 36, 4));
				} else if ($opt2 == "yards") {
					echo ($someNum1);
				}
			} else if ($opt1 == "inch") {
				if ($opt2 == "meters") {
					echo (round($someNum1 / 39.37, 4));
				} else if ($opt2 == "centimeters") {
					echo (round($someNum1 * 2.54, 4));
				} else if ($opt2 == "yards") {
					echo (round($someNum1 / 36, 4));
				} else if ($opt2 == "inch") {
					echo ($someNum1);
				}
			}
			///////////////////////////Temperature//////////////////////////////
			else if ($opt1 == "C") {
				if ($opt2 == "F") {
					echo (round(($someNum1 * 9 / 5) + 32, 4));
				} else if ($opt2 == "C") {
					echo ($someNum1);
				}
			} else if ($opt1 == "F") {
				if ($opt2 == "C") {
					echo (round(($someNum1 - 32) * 5 / 9, 4));
				} else if ($opt1 == "F") {
					echo ($someNum1);
				}
			} else {
				echo ("error");
			}
		}
		else{
			echo("pls enter correct num");
		}
		}
		function conv_select($option, $value)
		{
			if (($_POST[$option]) == $value) {
				echo ("selected");
			}
		}
		function conv_converter_func()
		{
			$all_options = get_option('conv_options'); // это массив
			// чтобы посмотреть все ключи и значения вы можете сделать так: print_r( $options );
			
			?><head>
			</head>
			<body>
			<form method="post" action="">
		<select id="1" name="select_options1" size=1>
			<?php if ($all_options['kilograms1']) {

			?><option <?php conv_select('select_options1', 'kilograms'); ?> class="weight" value="kilograms">Килограм</option>
			<?php } ?>
			<?php if ($all_options['pounds1']) {
			?><option <?php conv_select('select_options1', 'pounds'); ?> class="weight" value="pounds">Фунт</option>
			<?php } ?>
			<?php if ($all_options['meters1']) {
			?><option <?php conv_select('select_options1', 'meters'); ?> class="lenght" value="meters">Метр</option>
			<?php } ?>
			<?php if ($all_options['centimeters1']) {
			?><option <?php conv_select('select_options1', 'centimeters'); ?> class="lenght" value="centimeters">Сантиметр</option>
			<?php } ?>
			<?php if ($all_options['yards1']) {
			?><option <?php conv_select('select_options1', 'yards'); ?> class="lenght" value="yards">Ярд</option>
			<?php } ?>
			<?php if ($all_options['inch1']) {
			?><option <?php conv_select('select_options1', 'inch'); ?> class="lenght" value="inch">Дюйм</option>
			<?php } ?>
			<?php if ($all_options['C1']) {
			?><option <?php conv_select('select_options1', 'C'); ?> class="temo" value="C">градус Цельсия</option>
			<?php } ?>
			<?php if ($all_options['F1']) {
			?><option <?php conv_select('select_options1', 'F'); ?> class="temp" value="F">градус Фаренгейта</option>
			<?php } ?>
		</select>
		<input name="inputNum1" type="number" value=<?php if (isset($_POST['calculate'])) {
														echo sanitize_text_field(($_POST['inputNum1']));
													} ?>>
		<input name="inputNum2" type="number" value=<?php if (isset($_POST['calculate'])) {
														conv_converter();
													} ?>>
		<select id="2" name="select_options2" size=1>
			<?php if ($all_options['kilograms2']) {
			?><option <?php conv_select('select_options2', 'kilograms'); ?> class="weight" value="kilograms">Килограм</option>
			<?php } ?>
			<?php if ($all_options['pounds2']) {
			?><option <?php conv_select('select_options2', 'pounds'); ?> class="weight" value="pounds">Фунт</option>
			<?php } ?>
			<?php if ($all_options['meters2']) {
			?><option <?php conv_select('select_options2', 'meters'); ?> class="lenght" value="meters">Метр</option>
			<?php } ?>
			<?php if ($all_options['centimeters2']) {
			?><option <?php conv_select('select_options2', 'centimeters') ?> class="lenght" value="centimeters">Сантиметр</option>
			<?php } ?>
			<?php if ($all_options['yards2']) {
			?><option <?php conv_select('select_options2', 'yards'); ?> class="lenght" value="yards">Ярд</option>
			<?php } ?>
			<?php if ($all_options['inch2']) {
			?><option <?php conv_select('select_options2', 'inch'); ?> class="lenght" value="inch">Дюйм</option>
			<?php } ?>
			<?php if ($all_options['F2']) {
			?><option <?php conv_select('select_options2', 'F'); ?> class="temp" value="C">градус Цельсия</option>
			<?php } ?>
			<?php if ($all_options['C2']) {
			?><option <?php conv_select('select_options2', 'C'); ?> class="temp" value="F">градус Фаренгейта</option>
			<?php } ?>
		</select>
		<input name="calculate" value="<?php echo ($all_options['buttonText']); ?>" type="submit">
		<?php add_action( 'wp_enqueue_scripts', 'conv_true_include_myscript' ); ?>
	</form>
<script>
function hiding() {
if (select1V == "kilograms" || select1V == "pounds") {
	select2.selectedIndex = 0;
	for (var i = 0; i < weight.length; i++) 
		weight[i].style.display = "block";
	for (var i = 0; i < lengh.length; i++) 
		lengh[i].style.display = "none";
	for (var i = 0; i < temp.length; i++) 
		temp[i].style.display = "none";
} else if (select1V == "C" || select1V == "F") {
	select2.selectedIndex = 6;
	for (var i = 0; i < lengh.length; i++) 
		lengh[i].style.display = "none";
	for (var i = 0; i < weight.length; i++) 
		weight[i].style.display = "none";
	for (var i = 0; i < temp.length; i++) 
		temp[i].style.display = "block";
} else {
	select2.selectedIndex = 2;
	for (var i = 0; i < lengh.length; i++) 
		lengh[i].style.display = "block";
	for (var i = 0; i < weight.length; i++) 
		weight[i].style.display = "none";
	for (var i = 0; i < temp.length; i++) 
		temp[i].style.display = "none";
}
}
let select1 = document.getElementById("1");
select1V = select1.value;
let select2 = document.getElementById("2");
let lengh = select2.getElementsByClassName("lenght");
let weight = select2.getElementsByClassName("weight");
let temp = select2.getElementsByClassName("temp");
hiding();
select1.addEventListener("change", () => {
let select1 = document.getElementById("1");
select1V = select1.value;
let select2 = document.getElementById("2");
let lengh = select2.getElementsByClassName("lenght");
let weight = select2.getElementsByClassName("weight");
let temp = select2.getElementsByClassName("temp");
hiding();
});
</script>
</body><?php
		}
		add_shortcode('converter', 'conv_converter_func');
