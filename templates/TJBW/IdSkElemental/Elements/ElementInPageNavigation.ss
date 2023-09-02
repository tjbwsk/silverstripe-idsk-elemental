<% template 'Rasstislav/IdSk/Includes/Components/InPageNavigation/InPageNavigation' %>
	<% set Navigation %>
		<% include Rasstislav/IdSk/Includes/Components/InPageNavigation/Navigation Items=$ExistingNavigationItems %>
	<% end_set %>
	<% set Content %>
		<% include TJBW/IdSkElemental/Includes/ElementTitle %>
		$Elements
	<% end_set %>
<% end_template %>
