<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb" colspan="3">{lang:mod_name} - {lang:cashdesk}</td>
  </tr>
  <tr>
    <td class="leftb" style="width:30%"><a href="{url:lanshop_manage}">{lang:manage}</a></td>
    <td class="centerb"><a href="{url:lanshop_delivery}">{lang:delivery}</a></td>
    <td class="rightb" style="width:30%"><a href="{url:lanshop_export}">{lang:export}</a></td>
  </tr>
</table>
<br />

<form method="post" id="lanshop_cashdesk" action="{url:lanshop_cashdesk}">
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="leftc">
      {lang:category}
    </td>
    <td class="leftb">
      {head:cat_dropdown}
    </td>
    <td class="leftc">
      {lang:status}
    </td>
    <td class="leftb">
      {head:status_dropdown}
    </td>
    <td class="leftc">
      {lang:options}
    </td>
  </tr>
  <tr>
    <td class="leftc">
      {lang:user}
    </td>
    <td class="leftb" colspan="3">
      <input type="text" name="search_name" id="search_name" value="{search:name}" autocomplete="off" onkeyup="Clansphere.ajax.user_autocomplete('search_name', 'search_users_result', '{page:path}')" size="50" maxlength="100" />
      <div id="search_users_result"></div>
    </td>
    <td class="leftb">
      <input type="submit" name="submit" value="{lang:show}" />
    </td>
  </tr>
</table>
</form>
<br />

{if:user}
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{lang:name}</td>
    <td class="headb" colspan="2">{lang:status}</td>
    <td class="headb" colspan="2">{lang:basket}</td>
    <td class="headb">{lang:money}</td>
  </tr>
  {loop:orders}
  <tr>
    <td class="leftc">{orders:article}</td>
    <td class="leftc">{orders:status}</td>
    <td class="leftc">{orders:pay_id}</td>
    <td class="rightc">{orders:value}</td>
    <td class="centerc">{orders:remove_id}</td>
    <td class="rightc">{orders:cost}</td>
  </tr>
  {stop:orders}
</table>
<br />
{stop:user}

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="centerb">{bottom:body}</td>
  </tr>
</table>