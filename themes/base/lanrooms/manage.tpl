<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="3">{lang:mod_name} - {lang:head_manage}</td>
 </tr>
 <tr>
  <td class="leftb">{icon:contents} {lang:all} {head:count}</td>
  <td class="rightb">{pages:list}</td>
 </tr>
 <tr>
  <td class="leftb" colspan="3">
    <form method="post" id="lanrooms_manage" action="{url:form}">
    <fieldset style="border: 0; padding: 0">
      {lang:select_lan} 
      <select name="lanpartys_id" >
        <option value="0">----</option>
        {loop:lan}
		<option value="{lan:id}">{lan:name}</option>
		{stop:lan}
      </select>
      <input type="submit" name="submit" value="{lang:show}" />
    </fieldset>
    </form>
  </td>
 </tr>
</table>
<br />
{head:message}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb">{sort:name}{lang:name}</td>
  <td class="headb" style="width:200px"colspan="3">{lang:options}</td>
 </tr>
 {loop:lanrooms}
 <tr>
  <td class="leftc">{lanrooms:name}</td>
  <td class="leftc">{lanrooms:map}</td>
  <td class="leftc">{lanrooms:edit}</td>
  <td class="leftc">{lanrooms:del}</td>
 </tr>
 {stop:lanrooms}
</table>