export const locations = {
    group: "[data-password='visibility']",
    input: "[data-password-target]",
    event: [
        ...document.querySelectorAll("[data-password-visibility='close']"),
        ...document.querySelectorAll("[data-password-visibility='show']")
    ]
}