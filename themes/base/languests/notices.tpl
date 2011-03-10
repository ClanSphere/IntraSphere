<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="3">{lang:mod_name} - {lang:notices}</td>
  </tr>
  <tr>
    <td class="leftb">{icon:contents} {lang:total}: {count:all}</td>
    <td class="rightb" style="width:25%">{pages:list}</td>
  </tr>
  <tr>
    <td class="leftb">
      <form method="post" id="languests_notices" action="{url:form}">
      <fieldset style="border: 0; padding: 0">
        {lang:select_lan} 
        <select name="where" >
          <option value="0">----</option>
          {loop:lanpartys}
          <option value="{lanpartys:id}">{lanpartys:name}</option>
          {stop:lanpartys}
        </select>
        <input type="submit" name="submit" value="{lang:show}" />
        </fieldset>
      </form></td>
    <td class="rightb">{lang:manage}</td>
  </tr>
</table>
<br />
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{sort:user} {lang:user}</td>
    <td class="headb">{sort:notices} {lang:notices}</td>
    <td class="headb" colspan="3">{lang:options}</td>
  </tr>
  {loop:languests}
  <tr>
    <td class="leftc">{languests:user}</td>
    <td class="leftc">{languests:notices}</td>
    <td class="leftc">{languests:map}</td>
    <td class="leftc">{languests:edit}</td>
    <td class="leftc">{languests:remove}</td>
  </tr>
  {stop:languests}
</table>