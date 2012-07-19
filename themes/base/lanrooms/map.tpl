<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:head_map}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:body}</td>
  </tr>
</table>
<br />

{lan:map}
<br />

<form method="post" id="lanrooms_map" action="{url:form}">
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="leftc">{lang:number}</td>
    <td class="leftc">{lang:row}</td>
    <td class="leftc">{lang:col}</td>
    <td class="leftc">{lang:options}</td>
  </tr>
  <tr>
    <td class="leftb"><input type="text" name="lanroomd_number" value="{lan:number}" maxlength="4" size="4"  /></td>
    <td class="leftb"><input type="text" name="lanroomd_row" value="{lan:row}" maxlength="3" size="3"  /></td>
    <td class="leftb"><input type="text" name="lanroomd_col" value="{lan:col}" maxlength="2" size="2"  /></td>
    <td class="leftb"><input type="hidden" name="id" value="{data:id}" /> <input type="submit" name="submit" value="Eintragen" />
    </td>
  </tr>
</table>
</form>
<br />

<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:number}</td>
    <td class="headb">{lang:row}</td>
    <td class="headb">{lang:col}</td>
    <td class="headb">{lang:options}</td>
  </tr>
{loop:lanrooms}
  <tr>
    <td class="leftc">{lanrooms:number}</td>
    <td class="leftc">{lanrooms:row}</td>
    <td class="leftc">{lanrooms:col}</td>
    <td class="leftc">{lanrooms:remove}</td>
  </tr>
{stop:lanrooms}
</table>