<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="leftc" style="border:0;{data:background}">
      <table cellpadding="0" cellspacing="2" class="lanroom">
        <tr>
          <td class="center">&nbsp;</td>
          <td class="center">&nbsp;</td>
          {loop:figures}
          <td class="center" style="width:15px">{figures:abc}</td>
          {stop:figures}
        </tr>
        <tr>
          <td class="left" colspan="{max:col}">{img:empty}</td>
        {loop:numbers}
        {if:max_col}
        </tr>          
        <tr>
          <td class="right">{numbers:123}</td>
          <td class="center">{numbers:empty}</td>
        {stop:max_col}
          <td class="center" style="width:15px">{numbers:output}</td>
        {stop:numbers}
        </tr>
      </table>
    </td>
  </tr>
</table>