<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb" colspan="3">{lang:mod_name} - {lang:head_export}</td>
  </tr>
  <tr>
    <td class="leftb" style="width:30%"><a href="{url:lanshop_manage}">{lang:manage}</a></td>
    <td class="centerb"><a href="{url:lanshop_delivery}">{lang:delivery}</a></td>
    <td class="rightb" style="width:30%"><a href="{url:lanshop_cashdesk}">{lang:cashdesk}</a></td>
  </tr>
</table>
<br />

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{lang:category}</td>
    <td class="headb">{lang:status_2}</td>
    <td class="headb">{lang:money}</td>
    <td class="headb">{lang:print}</td>
  </tr>
  {loop:cat}
  <tr>
    <td class="leftc">{cat:name}</td>
    <td class="rightc">{cat:totalvalue}</td>
    <td class="rightc">{cat:totalcost}</td>
    <td class="centerc"><a href="#" onclick="window.open('{page:path}features.php?mod=lanshop&amp;action=printcat&amp;id={cat:id}', '{lang:print}', 'width=800,height=600,scrollbars=yes'); return false">{icon:printmgr}</a></td>
  </tr>
  {stop:cat}
</table>