import { Log } from "/js/tests/runtime/feedback.js";

export const HANDLE_TESTS = {
    ShouldHandleTabClick: () => {
        const tabs = document.querySelectorAll("[tab-target]");

        if (!tabs.length)
            return Log("ERROR", {
                component: "tab",
                message: "O tab não foi encontrado",
            });

        for (const tab of tabs) {
            tab.click();
        }

        return Log("SUCCESS", {
            component: "tab",
            message: "O tab foi clicado com sucesso",
        });
    },
};
