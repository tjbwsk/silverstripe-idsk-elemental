<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $Content %><div class="govuk-body">$Content</div><% end_if %>
<% if $RemoveComponentBottomMargin %>
	<% include Rasstislav/IdSk/Includes/Components/Timeline/Timeline %>
<% else %>
	<% include Rasstislav/IdSk/Includes/Components/Timeline/Timeline ExtraClass='govuk-!-margin-bottom-6' %>
<% end_if %>
