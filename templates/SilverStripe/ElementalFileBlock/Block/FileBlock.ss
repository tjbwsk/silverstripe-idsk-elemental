<% if $Title && $ShowTitle %>
	$File.preview(1, $RemoveComponentBottomMargin)
<% else %>
	$File.preview(0, $RemoveComponentBottomMargin)
<% end_if %>
