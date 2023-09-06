<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% template 'Rasstislav/IdSk/Includes/Components/Crossroad/Crossroad' %>
	<% set ExtraClass %><% if not $RemoveComponentBottomMargin %> govuk-!-margin-bottom-6<% end_if %><% end_set %>
	<% set ShowMoreButton %><% if $Variant == 'idsk-crossroad-2' && $Items.Count > $CrossroadUpperThreshold || $Variant != 'idsk-crossroad-2' && $Items.Count > $CrossroadLowerThreshold %>true<% else %>false<% end_if %><% end_set %>
	<% set Body %>
		<div class="idsk-crossroad<% if $Variant %> $Variant<% else %> idsk-crossroad-1<% end_if %>">
			<% if $Variant == 'idsk-crossroad-2' %>
				<% loop $Items %>
					<% if $IsMedian %></div><div class="idsk-crossroad $Top.Variant"><% end_if %>
					<% include Rasstislav/IdSk/Includes/Components/Crossroad/CrossroadItem HideMobile=$CrossroadIsOneColumnItemHidden, TwoColumnsHide=$CrossroadIsTwoColumnItemHidden %>
				<% end_loop %>
			<% else %>
				<% loop $Items %>
					<% include Rasstislav/IdSk/Includes/Components/Crossroad/CrossroadItem OneColumnHide=$CrossroadIsOneColumnItemHidden %>
				<% end_loop %>
			<% end_if %>
		</div>
	<% end_set %>
<% end_template %>
