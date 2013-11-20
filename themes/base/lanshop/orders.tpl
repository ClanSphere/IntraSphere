<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb" colspan="2">{lang:mod_name} - {lang:head_orders}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body}</td>
    <td class="rightb">{head:pages}</td>
  </tr>
  <tr>
    <td class="leftb">
      <form method="post" id="lanshop_orders" action="{url:lanshop_orders}">
      <fieldset style="border: 0; padding: 0">
        {lang:category} {head:cat_dropdown}
        <input type="submit" name="submit" value="{lang:show}" />
        </fieldset>
      </form>
    </td>
    <td class="rightb"><a href="{url:lanshop_center}">{lang:center}</a></td>
  </tr>
</table>
<br />

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{sort:name} {lang:name}</td>
    <td class="headb">{sort:status} {lang:status}</td>
    <td class="headb" colspan="2">{lang:value}</td>
    <td class="headb">{sort:price} {lang:money}</td>
  </tr>
  {loop:orders}
  <tr>
    <td class="leftc"><a href="{url:lanshop_view:id={orders:articles_id}}">{orders:articles_name}</a></td>
    <td class="leftc">{orders:status}</td>
    <td class="rightc">{orders:value}</td>
    <td class="centerc">{orders:remove}</td>
    <td class="rightc">{orders:cost}</td>
  </tr>
  {stop:orders}
</table>
<br />

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="centerb">{bottom:body}</td>
  </tr>
</table>