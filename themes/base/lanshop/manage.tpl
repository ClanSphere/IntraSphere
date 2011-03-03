<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb" colspan="2">{lang:mod_name} - {lang:manage}</td>
	</tr>
	<tr>
		<td class="leftb">{icon:contents} {lang:total}: {head:count}</td>
		<td class="rightb">{head:pages}</td>
	</tr>
	<tr>
		<td class="leftb">
			<form method="post" id="lanshop_manage" action="{url:lanshop_manage}">
      <fieldset style="border: 0; padding: 0">
				{lang:category} {head:cat_dropdown}
				<input type="submit" name="submit" value="{lang:show}" />
        </fieldset>
        </form>
		</td>
		<td class="rightb"><a href="{url:lanshop_cashdesk}">{lang:cashdesk}</a></td>
	</tr>
</table>
<br />
{head:getmsg}

<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb">{sort:name} {lang:name}</td>
		<td class="headb">{sort:price} {lang:price}</td>
		<td class="headb" colspan="2">{lang:options}</td>
	</tr>
	{loop:articles}
	<tr>
		<td class="leftc"><a href="{url:lanshop_view:id={articles:id}}">{articles:name}</a></td>
		<td class="leftc">{articles:price}</td>
		<td class="leftc"><a href="{url:lanshop_edit:id={articles:id}}" title="{lang:edit}">{icon:edit}</a></td>
		<td class="leftc"><a href="{url:lanshop_remove:id={articles:id}}" title="{lang:remove}">{icon:editdelete}</a></td>
	</tr>
	{stop:articles}
</table>