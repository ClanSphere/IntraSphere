<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:edit}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body}</td>
  </tr>
</table>
<br />

<form method="post" id="lanshop_edit" action="{url:lanshop_edit}">
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="leftb">{icon:folder_yellow} {lang:category} *</td>
    <td class="leftc">
      {ls:categories}
    </td>
  </tr>
  <tr>
    <td class="leftb">{icon:warehause} {lang:name} *</td>
    <td class="leftc"><input type="text" name="lanshop_articles_name" value="{data:lanshop_articles_name}" maxlength="80" size="40" /></td>
  </tr>
  <tr>
    <td class="leftb">{icon:money} {lang:price} *</td>
    <td class="leftc">
      {lang:editprice_info}<br />
      <input type="text" name="lanshop_articles_price" value="{data:lanshop_articles_price}" maxlength="8" size="8" /> {ls:price}
    </td>
  </tr>
  <tr>
    <td class="leftb">{icon:documentinfo} {lang:info}<br />
      <br />
      {abcode:smileys}
    </td>
    <td class="leftc">
      {abcode:features}
      <textarea class="rte_abcode" name="lanshop_articles_info" cols="50" rows="6" id="lanshop_articles_info">{data:lanshop_articles_info}</textarea>
    </td>
  </tr>
  <tr>
    <td class="leftb">{icon:ksysguard} {lang:options}</td>
    <td class="leftc">
      <input type="hidden" name="id" value="{lanshop:id}" />
      <input type="submit" name="submit" value="{lang:edit}"/>
    </td>
  </tr>
</table>
</form>