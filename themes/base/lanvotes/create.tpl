<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:head_create}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:body}</td>
  </tr>
</table>

<br />

<form method="post" id="lanvotes_create" action="{url:form}">
  <table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
    <tr>
      <td class="leftb">{icon:connect_to_network} {lang:lanparty} *</td>
      <td class="leftc"><select name="lanpartys_id" >
          <option value="0">----</option>
          {loop:lanpartys}
      <option value="{lanpartys:id}">{lanpartys:name}</option>
      {stop:lanpartys}
        </select>
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:status_unknown} {lang:status} *</td>
      <td class="leftc"><select name="lanvotes_status" >
          {lang:status_1}
      {lang:status_3}
      {lang:status_4}
      {lang:status_5}
        </select>
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:1day} {lang:start} *</td>
      <td class="leftc">{lanvotes:start}
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:today} {lang:end} *</td>
      <td class="leftc">{lanvotes:end}
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kate} {lang:question} *</td>
      <td class="leftc"><input type="text" name="lanvotes_question" value="{lanvotes:question}" maxlength="80" size="40"  />
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kate} {lang:answer} *
      <br />
        <br />
        {lang:seperate_by_enter}</td>
      <td class="leftc"><textarea class="rte_abcode" name="lanvotes_election" cols="50" rows="8" id="lanvotes_election">{lanvotes:election}</textarea>
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:ksysguard} {lang:options}</td>
      <td class="leftc"><input type="submit" name="submit" value="{lang:submit}" />
      </td>
    </tr>
  </table>
</form>
