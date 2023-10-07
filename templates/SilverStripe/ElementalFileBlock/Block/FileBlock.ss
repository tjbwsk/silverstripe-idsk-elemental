<% if $Title && $ShowTitle %>
	$File.preview($Title, $RemoveComponentBottomMargin)
<% else %>
	$File.preview('', $RemoveComponentBottomMargin)
<% end_if %>
