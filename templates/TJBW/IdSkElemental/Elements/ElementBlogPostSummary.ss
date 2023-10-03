<% with $TopPage %>
	<% if $Summary %>
		<div class="typography<% if $Up.RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% else %> govuk-!-margin-bottom-6<% end_if %>">$Summary</div>
	<% end_if %>
<% end_with %>
