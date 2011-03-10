<div class="left" style="float:left">{icon:printmgr} <a href="#" onclick="window.print(); return false">{lang:print}</a></div>
<div class="right" style="float:right">{lang:time}: {time:now}</div>
<br style="clear:both" /><br />

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="leftc">{icon:folder_yellow} {lang:category}</td>
    <td class="leftb">{data:category}</td>
  </tr>
  <tr>
    <td class="leftc">{icon:warehause} {lang:orders_value}</td>
    <td class="rightb">{data:totalvalue}</td>
  </tr>
  <tr>
    <td class="leftc">{icon:money} {lang:orders_price}</td>
    <td class="rightb">{data:totalcost}</td>
  </tr>
</table>
<br />

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{lang:product}</td>
    <td class="headb">{lang:value}</td>
    <td class="headb">{lang:money}</td>
  </tr>
  {loop:orders}
  {if:user}
  <tr>
    <td class="centerb" colspan="3">
      {lang:user}: {orders:users_id} -&gt; {orders:user}
    </td>
  </tr>
  {stop:user}
  <tr>
    <td class="leftc">{orders:article}</td>
    <td class="rightc">{orders:value}</td>
    <td class="rightc">{orders:money}</td>
  </tr>
  {stop:orders}
</table>