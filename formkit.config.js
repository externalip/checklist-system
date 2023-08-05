// formkit.config.js
import { generateClasses } from "@formkit/themes";
import { genesisIcons } from "@formkit/icons";
import myTailwindTheme from "./tailwind-theme.js"; // change to your theme's path
import { fr } from "@formkit/i18n";

export default {
    icons: {
        ...genesisIcons,
    },
    config: {
        classes: generateClasses(myTailwindTheme),
        locales: { fr },
        locale: "fr",
    },
};
