// Init function
var gaCheckbox = document.getElementById('ga-cookies');
var preferencesCheckbox = document.getElementById('preferences-cookies');

(function intCookies() {
  gaCheckbox.checked = (window.localStorage.getItem('googleAnalytics') === 'true');
  preferencesCheckbox.checked = (window.localStorage.getItem('preferences') === 'true');
})();

// Handle save cookie preferencies button
var saveCookieButton = document.getElementsByClassName('save-cookie-settings')[0];
if (saveCookieButton) {
  saveCookieButton.onclick = function () {
    window.localStorage.setItem('acceptedCookieBanner', 'true');
    window.localStorage.setItem('googleAnalytics', gaCheckbox.checked);
    window.localStorage.setItem('preferences', preferencesCheckbox.checked);
    location.reload();
  }
}
