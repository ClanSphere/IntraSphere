<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:head_edit}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:body}</td>
  </tr>
</table>

<br />

<form method="post" id="lanrooms_edit" action="{url:form}" enctype="multipart/form-data">
  <table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
    <tr>
      <td class="leftb">{icon:connect_to_network} {lang:lanparty} *</td>
      <td class="leftc"><select name="lanpartys_id" >
          <option value="{lan_old:id}">{lan_old:name}</option>
		  <option value="0">----</option>
          {loop:lan}
		  <option value="{lan:id}">{lan:name}</option>
		  {stop:lan}
        </select>
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kate} {lang:name} *</td>
      <td class="leftc"><input type="text" name="lanrooms_name" value="{lanroom:name}" maxlength="80" size="40"  />
      </td>
    </tr>
  <tr>
    <td class="leftb">{icon:download} {lang:background_img}</td>
    <td class="leftc">
      <input type="file" name="background" value="" /><br />
      <br />
      {data:picup_clip}
    </td>
  </tr>
  {if:more}
  <tr>
    <td class="leftb">{icon:configure} {lang:more}</td>
    <td class="leftc"><input type="checkbox" name="delete" value="1" />{lang:pic_remove}</td>
  </tr>
  {stop:more}
    <tr>
      <td class="leftb">{icon:ksysguard} {lang:options}</td>
      <td class="leftc">
	  <input type="hidden" name="id" value="{data:id}" />
    <input type="hidden" name="lanrooms_background" value="{data:lanrooms_background}" />
	  <input type="submit" name="submit" value="{lang:submit}" />
      </td>
    </tr>
  </table>
</form>
<br />

{data:map}