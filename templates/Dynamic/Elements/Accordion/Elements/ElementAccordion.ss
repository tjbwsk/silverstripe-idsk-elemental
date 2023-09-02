<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $Content %><div class="govuk-body">$Content</div><% end_if %>
<% if $RemoveComponentBottomMargin %>
	<% include Rasstislav/IdSk/Includes/Components/Accordion/Accordion Identifier=$ID, Items=$Panels, ExtraClass='govuk-!-margin-bottom-0' %>
<% else %>
	<% include Rasstislav/IdSk/Includes/Components/Accordion/Accordion Identifier=$ID, Items=$Panels, ExtraClass='govuk-!-margin-bottom-6' %>
<% end_if %>
