<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $RemoveComponentBottomMargin %>
	<% include Rasstislav/IdSk/Includes/Components/Table/Table TableBodyRows=$Rows, TableExtraClass='govuk-!-margin-bottom-0' %>
<% else %>
	<% include Rasstislav/IdSk/Includes/Components/Table/Table TableBodyRows=$Rows, TableExtraClass='govuk-!-margin-bottom-6' %>
<% end_if %>
