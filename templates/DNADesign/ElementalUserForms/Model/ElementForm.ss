<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $Form.FormName %>
	<% if $RemoveComponentBottomMargin %>
		$Form.setAttribute('class', 'idsk-form reset-margin-bottom')
	<% else %>
		$Form.setAttribute('class', 'idsk-form')
	<% end_if %>
<% else %>
	<% if $RemoveComponentBottomMargin %>
		$Form
	<% else %>
		<div class="govuk-!-margin-bottom-6">
			$Form
		</div>
	<% end_if %>
<% end_if %>
