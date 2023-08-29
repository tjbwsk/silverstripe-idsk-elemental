<% if $LinkedElement %>
	<div id="{$LinkedElement.Anchor}"<% if $LinkedElement.StyleVariant %> class="$LinkedElement.StyleVariant"<% end_if %>>
		$Element
	</div>
<% end_if %>
