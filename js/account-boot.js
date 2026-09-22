/*
 * account-boot.js — sign-in for thewizardofoza.com.
 *
 * The apex is sign-in only: nothing is sold here. account.js, account-ui.js,
 * ui.js and css/account.css are copied unchanged from GameHub's
 * setup/starter-kit — fix them there and re-copy, never here, or the apex
 * drifts from every other app on the domain.
 *
 * Nothing on the site waits on this. init() is deliberately not awaited: the
 * pages must render and work with api.thewizardofoza.com unreachable, and a
 * visitor who never signs in loses nothing.
 */

import { createAccount } from "./account.js";
import { initAccountUI } from "./account-ui.js";
import { initSheets, toast } from "./ui.js";

const account = createAccount({
  apiUrl:  "https://api.thewizardofoza.com",
  appSlug: "hub",          // nothing is sold here; the slug is just a label
});

initSheets();
const ui = initAccountUI(account, { appName: "The Wizard of Oza" });

const button = document.getElementById("account-btn");
if (button) {
  button.addEventListener("click", () => ui.open());
  account.onChange(() => button.classList.toggle("is-signed-in", account.signedIn()));
}

account.init().then(({ recoveryToken, error }) => {
  if (recoveryToken) ui.openReset(recoveryToken);
  if (error) toast("Sign-in did not complete. Please try again.");
});
