<div data-module="idsk-intro-block">
	<div class="idsk-intro-block<% if not $RemoveComponentBottomMargin %> govuk-!-margin-bottom-6<% end_if %>">
		<div class="govuk-grid-row">
			<div class="govuk-grid-column-full<% if $SideMenuTitle && $SideMenuItems %> govuk-grid-column-two-thirds-from-desktop<% end_if %>">
				<div class="govuk-heading-m<% if not $SideMenuTitle || not $SideMenuItems %> govuk-!-margin-top-0<% else_if $ShowSearchForm && not $BottomMenuTitle || $ShowSearchForm && not $BottomMenuItems %> heading-bigger-margin<% end_if %>">
					<% include TJBW/IdSkElemental/Includes/ElementTitle TitleSizeClass='govuk-heading-m govuk-!-margin-0' %>
				</div>
				<% if $Content %><div class="typography">$Content</div><% end_if %>
				<% if $ShowSearchForm %>
					$IntroBlockSearchForm
					<% if $BottomMenuTitle && $BottomMenuItems %>
						<div>
							<ul class="idsk-intro-block__list__ul">
								<li class="idsk-intro-block__bottom-menu__li govuk-caption-m">
									<span>$BottomMenuTitle</span>
								</li>
								<% loop $BottomMenuItems %>
									<li class="idsk-intro-block__list__li">
										<a href="$Link" title="$MenuTitle"<% if $IsNewWindow %> target="_blank" rel="noreferrer noopener"<% end_if %> class="govuk-link idsk-intro-block__list__a">
											$MenuTitle
										</a>
									</li>
								<% end_loop %>
							</ul>
						</div>
					<% end_if %>
				<% end_if %>
			</div>
			<% if $SideMenuTitle && $SideMenuItems %>
				<div class="idsk-intro-block__side-menu govuk-grid-column-full govuk-grid-column-one-third-from-desktop<% if $Variant %> $Variant<% end_if %>">
					<h3 class="govuk-heading-s">$SideMenuTitle</h3>
					<ul class="idsk-intro-block__side-menu__ul">
						<% loop $SideMenuItems %>
							<li class="idsk-intro-block__side-menu__li<% if $Last %> govuk-!-padding-bottom-0<% end_if %>">
								<a href="$Link" title="$MenuTitle"<% if $IsNewWindow %> target="_blank" rel="noreferrer noopener"<% end_if %> class="govuk-link idsk-intro-block__side-menu__a">$MenuTitle</a>
							</li>
						<% end_loop %>
					</ul>
				</div>
			<% end_if %>
		</div>
	</div>
</div>
