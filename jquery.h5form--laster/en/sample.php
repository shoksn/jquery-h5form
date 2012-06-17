<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>HTML5 Form Validation Plugin</title>

	<link rel="stylesheet" type="text/css" href="/lib/css/smoothness/jquery-ui-custom.css" />
	<link rel="stylesheet" type="text/css" href="../css/jquery.h5form--laster.css" />
	<style style="text/css">
	  body, td, input, select, textarea { font-size: 10pt; }
	  h1 { font-family: Verdana, sans-serif; font-size: 18pt; }
	  th { text-align: right; vertical-align: top; width: 10em; }
	  input, textarea { border: 1px solid #7F9DB9; border-radius: 3px; }
	  button[type="submit"] { padding: 2px 20px }
	  #result pre { border: 2px solid gray; background-color: pink; padding: 1em;  }
	  #close_result { float: right; color: blue; margin: 3px; }

	  .source { position:absolute; display: none; border: 2px solid orange; padding: 5px 10px; color: dimgray; background-color: white; border-radius: 8px; box-shadow: 3px 3px 6px gainsboro; z-index: 3; width:400px; }
	  .source strong { color: firebrick; font-weight: normal; }

	  footer { display: block; margin: 1em 6em; }
	</style>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="jquery.h5form--laster.js"></script>
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<script type="text/javascript">
		$(function() {
			$('form').h5form({ dinamicHtml: '[name="password"]'});

			// Course-B required email
			$('select[name="course"]').change(function() {
				if ($(this).val() == 'B') {
					$(':password').attr('required', 'required');
				} else {
					$(':password').removeAttr('required');
				}
			}).change();

			// Copy email.value to email2.pattern
			$('[name="email"]').change(function() {
				$('[name="email2"]').attr('pattern', $(this).val().replace(/\W/g, '\\$&'));
				if ($(this).val() != '') {
					$('[name="email2"]').attr('required', 'required');
				} else {
					$('[name="email2"]').removeAttr('required');
				}
			}).change();

			// Close result
			$('#close_result').click(function() {
				$('#result').hide();
			});

			// Show source
			$('th').hover(
				function() {
					$(this).next().children('.source').show();
				},
				function() {
					$(this).next().children('.source').hide();
				}
			);
		});
	</script>

  <?php  if (file_exists('../../site.inc.php')) include '../../site.inc.php'; ?>
  </head>

  <body>

	<h1>HTML5 Form Validation Plugin</h1>

	<p>This plugin gives all browsers the HTML5 form validation such as Opera.<br>
	  And this will also fix all of the bug in IE on submit, and will allow you to use button elements.</p>


	<form action="" method="post">
	  <table>
		<tr>
		  <th>Course</th>
		  <td>
			<select name="course" required>
			  <option value="">Please select.</option>
			  <option value="A"<?php if (isset($_POST['course']) && $_POST['course'] == 'A') echo ' selected';?>>Course A</option>
			  <option value="B"<?php if (isset($_POST['course']) && $_POST['course'] == 'B') echo ' selected';?>>Course B (required password)</option>
			</select>
			<br>
			<div class="source">
			  &lt;select name="cource" <strong>required</strong>&gt;&lt;/select&gt;
<pre>
// Course-B required email
$('select[name="course"]').change(function() {
  if ($(this).val() == 'B') {
    $(':password').attr('required', 'required');
  } else {
    $(':password').removeAttr('required');
  }
}).change();
</pre>
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Name</th>
		  <td>
			<input type="text" name="name" size="40" value="<?php echo $_POST['name']?>" required>
			<br>
			<div class="source">
			  &lt;input type="text" name="name" size="40" <strong>required autofocus</strong>&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Nickname</th>
		  <td>
			<input type="text" name="nickname" value="<?php echo $_POST['nickname']?>" pattern="[A-Za-z0-9_.-]{4,}" title="Please enter four or more alphanumeric characters.">
			<br>
			<div class="source">
			  &lt;input type="text" name="kana" <strong>pattern="[A-Za-z0-9_.-]{4,}"</strong> title="Please enter four or more alphanumeric characters."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Password</th>
		  <td>
<?php if (isset($_POST['password']) && strlen($_POST['password']) &&
  (!preg_match('/[0-9]/', $_POST['password']) || !preg_match('/[A-Z]/i', $_POST['password']))) :?>
			<div class="h5form-response"><p>Please use both letters and numbers.<br>
			  <span style="font-size: smaller; color:red">This message is output by PHP.</span></p></div>
<?php endif; ?>
			<input type="password" name="password" value="<?php echo $_POST['password']?>" pattern="[!-~]{8,16}" maxlength="16" title="Please enter the alphanumeric symbol 4 to 16 characters.">
			<br>
			<div class="source">
			  &lt;input type="password" name="password" <strong>pattern="[!-~]{8,16}"</strong> maxlength="16" title="Please enter the alphanumeric symbol 4 to 16 characters."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>E-mail</th>
		  <td>
			<input type="email" name="email" size="40" value="<?php echo $_POST['email'] ?>"><br>
			<input type="email" name="email2" size="40" value="<?php echo $_POST['email2'] ?>" placeholder="Please re-enter for confirmation." title="Please enter the same address as above.">
			<br>
			<div class="source">
			  &lt;input <strong>type="email"</strong> name="email" size="40"&gt;&lt;br&gt;<br>
			  &lt;input <strong>type="email"</strong> name="email2" size="40" placeholder="Please re-enter for confirmation." title="Please enter the same address as above."&gt;<br>
<pre>
// Copy email.value to email2.pattern
$('[name="email"]').change(function() {
  $('[name="email2"]').attr('pattern',
            $(this).val().replace(/\W/g, '\\$&'));
  if ($(this).val() != '') {
    $('[name="email2"]').attr('required', 'required');
  } else {
    $('[name="email2"]').removeAttr('required');
  }
}).change();
</pre>
			</div>
		  </td>
		</tr>

		<tr>
		  <th>URL</th>
		  <td>
			<input type="url" name="url" size="40" value="<?php echo $_POST['url'] ?>" placeholder="http://">
			<br>
			<div class="source">
			  &lt;input <strong>type="url"</strong> name="url" size="40" placeholder="http://"&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Telephone</th>
		  <td>
			<input type="tel" name="tel" pattern="0\d{1,5}-\d{1,4}-\d{4}" size="40" placeholder="0xx-xxxx-xxxx" title="Please enter valid phone number separated by a hyphen minus." value="<?php echo $_POST['tel'] ?>">
			<br>
			<div class="source">
			  &lt;input <strong>type="tel"</strong> name="tel" <strong>pattern="0\d{1,5}-\d{1,4}-\d{4}"</strong> size="40" placeholder="0xx-xxxx-xxxx" title="Please enter valid phone number separated by a hyphen minus."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Number</th>
		  <td>
			<input type="number" name="number" min="12" max="28" step="0.5" size="4" title="From 12cm to 28cm in 0.5cm increments." value="<?php echo $_POST['number'] ?>">
			<br>
			<div class="source">
			  &lt;input <strong>type="number"</strong> name="number" <strong>min="12" max="28" step="0.5"</strong> size="4" title="From 12cm to 28cm in 0.5cm increments."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Range</th>
		  <td>
			<input type="range" name="range" min="40" max="80" step="2" value="<?php echo $_POST['range'] ?>">
			<br>
			<div class="source">
			  &lt;input <strong>type="range"</strong> name="range" <strong>min="40" max="80" step="2"</strong>&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Date / time</th>
		  <td>
			<input type="date" name="date" min="<?php echo date('Y-m-d', strtotime('+2 day'));?>" max="<?php echo date('Y-m-d', strtotime('+3 month'));?>" size="8" title="Form the day after tomorrow or later." value="<?php echo $_POST['date'] ?>">
			<input type="time" name="time" min="07:00" max="18:00" step="1800" size="8" value="<?php echo $_POST['time']?>" title="From 07:00 to 18:00 in 30min increments.">
			<br>
			<div class="source">
			  &lt;input <strong>type="date"</strong> name="date" <strong>min="<?php echo date('Y-m-d', strtotime('+2 day'));?>" max="<?php echo date('Y-m-d', strtotime('+3 month'));?>"</strong> size="8" title="Form the day after tomorrow or later."&gt;<br>
			  &lt;input <strong>type="time"</strong> name="time" <strong>min="07:00" max="18:00" step="1800"</strong> size="8" title="From 07:00 to 18:00 in 30min increments."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Datetime</th>
		  <td>
			<input type="datetime" name="datetime" min="<?php echo date('Y-m-d\TH:i:sP', ceil(time()/600)*600);?>" max="<?php echo date('Y-m-d\TH:i:sP', ceil(strtotime('+2 day')/600)*600);?>" step="600" size="8" title="48 hours from now in 10min increments." value="<?php echo $_POST['datetime'] ?>">
			<br>
			<div class="source">
			  &lt;input <strong>type="datetime"</strong> name="datetime" <strong>min="<?php echo date('Y-m-d\TH:i:sP', ceil(time()/600)*600);?>" max="<?php echo date('Y-m-d\TH:i:sP', ceil(strtotime('+2 day')/600)*600);?>"</strong> step="600" size="8" title="48 hours from now in 10min increments."&gt;<br>
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Datetime-local</th>
		  <td>
			<input type="datetime-local" name="datetime-local" min="<?php echo date('Y-m-d\TH:i:s', ceil(time()/600)*600);?>" max="<?php echo date('Y-m-d\TH:i:s', ceil(strtotime('+2 day')/600)*600);?>" step="600" size="8" title="48 hours from now in 10min increments." value="<?php echo $_POST['datetime-local'] ?>">
			<br>
			<div class="source">
			  &lt;input <strong>type="datetime"</strong> name="datetime" <strong>min="<?php echo date('Y-m-d\TH:i:s', ceil(time()/600)*600);?>" max="<?php echo date('Y-m-d\TH:i:s', ceil(strtotime('+2 day')/600)*600);?>"</strong> step="600" size="8" title="48 hours from now in 10min increments."&gt;<br>
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Color</th>
		  <td>
			<input type="color" name="color" size="8" value="<?php echo $_POST['color'] ?>"> (Not supported)
			<br>
			<div class="source">
			  &lt;input <strong>type="color"</strong> name="color" size="8" &gt;<br>
			</div>
		  </td>
		</tr>

		<tr>
		  <th>Note</th>
		  <td>
			<textarea name="note" maxlength="100" cols="40" title="Please enter less than 100 characters."><?php echo $_POST['note'] ?></textarea>
			<br>
			<div class="source">
			  &lt;textarea name="note" <strong>maxlength="100"</strong> cols="40" title="Please enter less than 100 characters."&gt;
			</div>
		  </td>
		</tr>

		<tr>
		  <th></th>
		  <td>
			<button name="submit" value="1">Submit 1</button>
			<button name="submit" value="2">Sbumit 2</button>
			<br>
			<div class="source">
			  &lt;button name="submit" value="1"&gt;Submit 1&lt;/button&gt;<br>
			  &lt;button name="submit" value="2"&gt;Submit 2&lt;/button&gt;
			</div>
		  </td>
		</tr>

	  </table>

	</form>

<?php if (isset($_POST['submit'])):?>
	<div id="result">
	  <span id="close_result">[Close]</span>
	  <pre>$_POST = <?php print_r($_POST); ?></pre>
	</div>
<?php endif; ?>

	<footer>
	  jquery.h5form--laster.js<br>
	  by Yoshiyuki Mikome <a href="http://www.rapidexp.com/wordpress/h5form/" target="_parent">http://www.rapidexp.com</a><br>
	  Download: <a href="http://www.rapidexp.com/lib/h5form/jquery.h5form--laster.zip" onClick="_gaq.push(['_trackEvent', 'Download', 'h5form', 'jquery.h5form--laster.zip']);">jquery.h5form--laster.zip</a><br>
	  Dual licensed under the MIT and GPL licenses.
    </footer>


  </body>
</html>
