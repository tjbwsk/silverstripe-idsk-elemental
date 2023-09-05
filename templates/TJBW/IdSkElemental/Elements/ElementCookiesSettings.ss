<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<div class="govuk-form-group">
	<div class="govuk-checkboxes">
		<div class="govuk-checkboxes__item">
			<input id="necessary-cookies" type="checkbox" name="necessary-cookies" checked disabled class="govuk-checkboxes__input">
			<label for="necessary-cookies" class="govuk-label govuk-checkboxes__label">
				Nevyhnutne nutné súbory cookie
			</label>
		</div>
	</div>
</div>

<% include Rasstislav/IdSk/Includes/Components/Typography/InsetText Content='Sú to základné súbory cookie, ktoré umožňujú pohybovať sa po webovej stránke a používať jej funkcie. Tieto súbory cookie neukladajú žiadne informácie o vás, ktoré by sa dali použiť na marketing alebo na zapamätaniesi, čo ste si na internete pozerali.' %>

<div class="govuk-form-group">
	<div class="govuk-checkboxes">
		<div class="govuk-checkboxes__item">
			<input id="ga-cookies" type="checkbox" name="ga-cookies" class="govuk-checkboxes__input">
			<label for="ga-cookies" class="govuk-label govuk-checkboxes__label">
				Analytické súbory cookie
			</label>
		</div>
	</div>
</div>

<% include Rasstislav/IdSk/Includes/Components/Typography/InsetText Content='Tieto súbory zbierajú informácie o tom, ako sa používala webová stránka, napríklad ktoré stránky najčastejšie navštevujete a či sa vám zobrazili chybové hlásenia. Nezbierajú informácie, na základe ktorých by bolo možné zistiť vašu totožnosť. Všetky informácie sú anonymné. Používajú sa na zlepšenie funkčnosti webových stránok.' %>

<div class="govuk-form-group">
	<div class="govuk-checkboxes">
		<div class="govuk-checkboxes__item">
			<input id="preferences-cookies" type="checkbox" name="preferences-cookies" class="govuk-checkboxes__input">
			<label for="preferences-cookies" class="govuk-label govuk-checkboxes__label">
				Preferenčné súbory cookie
			</label>
		</div>
	</div>
</div>

<% include Rasstislav/IdSk/Includes/Components/Typography/InsetText Content='V týchto súboroch sa ukladajú vaše voľby (napr. jazykové preferencie) a osobné charakteristiky. Môžu sa v nich uložiť zmeny, ktoré ste na webovej stránke urobili. Dá sa zabezpečiť, aby sa informácie zbierali anonymne. Na ich základe nie je možné zistiť, ktoré iné webové stránky ste navštívili.' %>

<button data-module="idsk-button" type="submit" class="idsk-button save-cookie-settings<% if $RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% end_if %>">
	Uložiť nastavenia
</button>
