<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $Content %><div class="govuk-body">$Content</div><% end_if %>
<% if $PostsList %>
	<div class="idsk-card-list<% if $RemoveComponentBottomMargin && not $Blog %> reset-margin-bottom<% end_if %>">
		<% loop $PostsList %>
			<% include SilverStripe/Blog/PostSummary ShowBlogTitle=$Top.ShowBlogTitleInPosts %>
		<% end_loop %>
	</div>
	<% if $Blog %>
		<a href="$Blog.Link" data-module="idsk-button" role="button" title="Prejdite na stránku $Blog.Title" class="idsk-button<% if $RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% else %> govuk-!-margin-bottom-6<% end_if %>">Zobraziť všetky príspevky</a>
	<% end_if %>
<% else %>
    <p class="govuk-body<% if $RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% else %> govuk-!-margin-bottom-6<% end_if %>"><%t SilverStripe\\Blog\\Model\\Blog.NoPosts 'There are no posts' %></p>
<% end_if %>
