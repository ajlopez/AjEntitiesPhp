<?
$Months2 = array(
  Ene => 1, Feb => 2, Mar => 3, Abr => 4,
  May => 5, Jun => 6, Jul => 7, Ago => 8,
  Set => 9, Oct => 10, Nov => 11, Dic => 12
);

$Months = array(
  1 => Ene, 2 => Feb, 3 => Mar, 4 => Abr,
  5 => May, 6 => Jun, 7 => Jul, 8 => Ago,
  9 => Set, 10 => Oct, 11 => Nov, 12 => Dic
);

$Genres = array( 1 => Masculino, 2 => Femenino );

function FieldRowOpen() {
		echo "<tr>\n";
}

function FieldRowClose() {
		echo "</tr>\n";
}

function FieldOpen($align='left') {
		echo "<td class=datum align=$align valign=top>";
}

function FieldClose() {
		echo "</td>";
}

function SeparatorGenerate($legend='&nbsp;') {
	echo "<tr><td colspan=2 class=separator valign=top align=center>$legend</td></tr>\n";
}

function LegendGenerate($legend='&nbsp;',$required=false) {
	echo "<td class=legend valign=top>$legend";
	if ($required)
		echo " <font color=red>*</font>";
	echo "</td>\n";
}

function StaticGenerate($legend) {
		echo "$legend\n";
}

function LinkGenerate($legend,$link) {
		echo "<a href='$link'>$legend</a>";
}

function StaticMemoGenerate($legend,$eshtml=0) {
	if ($eshtml)
		echo $legend;
	else
		echo nl2br($legend) ."\n";
}

function StaticHtmlGenerate($legend) {
		echo nl2br($legend) ."\n";
}

function TitleGenerate($title) {
		echo "<h1>$title</h1>";
}

function TextGenerate($name,$value,$tamanio) {
		echo "<input type=text name=\"$name\" value=\"$value\" size=$tamanio>\n";
}

function FileGenerate($name,$size) {
		echo "<input type=file name=\"$name\" size=$size>\n";
}

function CheckGenerate($name,$legend,$value) {
	if ($value)
		$checked="checked";
	else
		$checked="";
	echo "<input type=checkbox name=\"$name\" value=\"1\" $checked> $legend\n";
}

function MemoGenerate($name,$value,$filas,$columnas) {
		echo "<textarea name=\"$name\" rows=$filas cols=$columnas>\n$value</textarea>";
}

function FileAreaGenerate($name,$archivo,$filas,$columnas) {
	echo "<textarea name=\"$name\" rows=$filas cols=$columnas>\n";
	$fp = @fopen($archivo,"r");
	if ($fp)
		fpassthru($fp);
	echo "</textarea>\n";
}

function PasswordGenerate($name,$value,$tamanio) {
		echo "<input type=password name=\"$name\" value=\"$value\" size=$tamanio>\n";
}

function DayGenerate($name,$value, $novalor=0) {
		echo "<select name='$name'>\n";
		if ($novalor)
			 echo "<option value=''></option>\n";
		for ($k=1; $k<=31; $k++) {
				$s = $k == $value ? " selected" : "";
				echo "<option value='$k' $s>$k</option>\n";
		}
		echo "</select>\n";
}

function MonthGenerate($name,$value, $novalor=0) {
		echo "<select name='$name'>\n";
	  global $Months;
    reset($Months);

		if ($novalor)
			 echo "<option value=''></option>\n";
		while (list($k, $v) = each($Months))  {
					$s = $k == $value ? " selected" : "";
    			echo "<option $s value=$k>$v</option>\n";
		}
		echo "</select>\n";
}

function YearGenerate($name,$value, $novalor=0) {
		echo "<select name='$name'>\n";
		if ($novalor)
			 echo "<option value=''></option>\n";
  for ($i=1900; $i<=2010; $i++)
  { $s = $i == $value ? " selected" : "";
    echo "<option $s value=$i>$i</option>\n";
  }
		echo "</select>\n";
}

function DateGenerate($name, $anio, $mes, $dia, $novalor=0) {
		DayGenerate($name . "Day", $dia, $novalor);
		MonthGenerate($name . "Month", $mes, $novalor);
		YearGenerate($name . "Year", $anio, $novalor);
}

function ComboHashGenerate($name,$arreglo,$value) {
		echo "<select name=\"$name\">\n";

		reset($arreglo);
		
		while (list($k, $v) = each($arreglo)) {
					$s = $k == $value ? " selected" : "";
					echo "<option$s value=\"$k\">$v</option>\n";
		}
		
		echo "</select>\n";
}

function ComboRsGenerate($name, $rs, $value, $id='id', $des='descripcion', $blank=0) {
	echo "<select name=\"$name\">\n";

	if ($blank)
		echo "<option value=''></option>\n";

	while ($reg=mysql_fetch_array($rs)) {
		if ($reg[$id]==$value)
			$s = "selected";
		else
			$s = "";
		echo "<option $s value=\"$reg[$id]\">$reg[$des]</option>\n";
	}

	echo "</select>\n";
}

function RadioHashGenerate($name,$arreglo,$value) {
		reset($arreglo);
		
		while (list($k, $v) = each($arreglo)) {
					$s = $k == $value ? " checked" : "";
					echo "<input type='radio' name='$name' $s value=\"$k\">$v&nbsp;<br>\n";
		}
}

function GenreGenerate($name, $value) {
		global $Genres;
		
		RadioHashGenerate($name, $Genres, $value);
}

function ComboArregloGenerate($name,$arreglo,$value) {
		echo "<select name=\"$name\">\n";

		reset($arreglo);
  		
		while (list(,$k) = each($arreglo)) {
					$s = $k == $value ? " selected" : "";
					echo "<option$s value=\"$k\">$k</option>\n";
		}
		
		echo "</select>\n";
}

function FieldIdGenerate($value) {
		echo "<input type=hidden name=\"Id\" value=\"$value\">\n";
}

function FieldHiddenGenerate($name,$value) {
		echo "<input type=hidden name=\"$name\" value=\"$value\">\n";
}

function FieldTextGenerate($name,$legend,$value,$tamanio=30,$required=false) {
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		TextGenerate($name,$value,$tamanio);
		FieldClose();
		FieldRowClose();
}

function FieldDateGenerate($name,$legend,$fecha,$required=0) {
		$anio = substr($fecha,0,4);
		$mes = substr($fecha,5,2);
		$dia = substr($fecha,8,2);
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		DateGenerate($name,$anio,$mes,$dia,1);
		FieldClose();
		FieldRowClose();
}

function FieldFileGenerate($name,$legend,$size=30) {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen();
		FileGenerate($name,$size);
		FieldClose();
		FieldRowClose();
}

function FieldMemoGenerate($name,$legend,$value,$filas=10,$columnas=40,$required=false) {
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		MemoGenerate($name,$value,$filas,$columnas);
		FieldClose();
		FieldRowClose();
}

function FieldFileAreaGenerate($name,$legend,$archivo,$filas=10,$columnas=40) {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen();
		FileAreaGenerate($name,$archivo,$filas,$columnas);
		FieldClose();
		FieldRowClose();
}

function FieldGenreGenerate($name,$legend,$value,$required=false) {
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		GenreGenerate($name,$value);
		FieldClose();
		FieldRowClose();
}

function FieldStaticGenerate($legend,$value,$align='left') {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen($align);
		StaticGenerate($value);
		FieldClose();
		FieldRowClose();
}

function FieldLinkGenerate($legend,$value,$link,$align='left') {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen($align);
		LinkGenerate($value,$link);
		FieldClose();
		FieldRowClose();
}

function FieldStaticMemoGenerate($legend,$value,$eshtml=0) {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen();
		StaticMemoGenerate($value,$eshtml);
		FieldClose();
		FieldRowClose();
}

function FieldStaticHtmlGenerate($legend,$value) {
		FieldRowOpen();
		LegendGenerate($legend);
		FieldOpen();
		StaticHtmlGenerate($value);
		FieldClose();
		FieldRowClose();
}

function FieldPasswordGenerate($name,$legend,$value,$tamanio=30,$required=false) {
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		PasswordGenerate($name,$value,$tamanio);
		FieldClose();
		FieldRowClose();
}

function FieldComboHashGenerate($name,$legend,$arreglo,$value,$required=false) {
		FieldRowOpen();
		LegendGenerate($legend,$required);
		FieldOpen();
		ComboHashGenerate($name,$arreglo,$value);
		FieldClose();
		FieldRowClose();
}

function FieldComboRsGenerate($name,$legend,$rs,$value,$id='Id',$des='Description',$blank=0,$required=false) {
	FieldRowOpen();
	LegendGenerate($legend,$required);
	FieldOpen();
	ComboRsGenerate($name,$rs,$value,$id,$des,$blank);
	FieldClose();
	FieldRowClose();
}

function FieldCheckGenerate($name,$legend,$value,$required=false) {
	FieldRowOpen();
	LegendGenerate("&nbsp;",$required);
	FieldOpen();
	CheckGenerate($name,$legend,$value);
	FieldClose();
	FieldRowClose();
}

function FieldOkGenerate() {
		echo "<td colspan=2 class='legend' align=center><input type='submit' value='Accept'></td>\n";
}

function FieldOkDeleteGenerate() {
	echo "<td colspan=2 class='legend' align=center><input type='submit' name='Accept' value='Accept'>\n";
	echo "<input type='submit' name='Delete' value='Delete'></td>\n";
}

function FormOpen($action='',$method='post') {
	if ($action)
		echo "<div align=center><form method='$post' action='$action'>\n";
	else
		echo "<div align=center><form method='$post' action='$action'>\n";
}

function FormClose() {
	echo "</form></div>\n";
}

function TableOpen($titles='',$width='') {
	if ($width)
		echo "<table width='$width' cellspacing=1 cellpadding=2 class='form'>\n";
	else
		echo "<table cellspacing=1 cellpadding=2 class='form'>\n";	

	if (is_array($titles)) {
		echo "<tr>\n";

		reset($titles);

		while (list($k,$v) = each($titles))
			if ($v)
				echo "<td class='title' align='center'>$v</td>";
			else
				echo "<td>&nbsp;</td>";

		echo "</tr>\n";
	}
}

function TableClose() {
	  echo "</table>\n";
}

function RowOpen() {
	  echo "<tr>\n";
}

function RowClose() {
	  echo "</tr>\n";
}

function DatumGenerate($datum,$align='left',$colspan=1) {
    echo "<td class='datum' colspan=$colspan valign='top' align=$align>$datum&nbsp;</td>\n";
}

function DatumNumGenerate($datum) {
    echo "<td class='datum' align='right'>$datum&nbsp;</td>\n";
}

function DatumCurrencyGenerate($datum) {
    echo "<td class='datum' align='right'>" . number_format($datum+0,2) . "&nbsp;</td>\n";
}

function DatumLinkGenerate($datum,$link,$align='left') {
    echo "<td class='datum' align='$align'><a href='$link'>$datum</a>&nbsp;</td>\n";
}

?>