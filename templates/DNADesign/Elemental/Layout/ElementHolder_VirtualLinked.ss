<% if $LinkedElement %>
	<div id="{$LinkedElement.Anchor}" class="$Element.ColumnClasses<% if $LinkedElement.StyleVariant %> $LinkedElement.StyleVariant<% end_if %>">
		$Element
	</div>
<% end_if %>
