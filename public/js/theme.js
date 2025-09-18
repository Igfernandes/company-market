import "/js/components/require.js";
import { exports } from "./exports/index.js";
import { resolvesPath } from "./helpers/resolvesPath.js";
import "/js/libraries/swiper/swiper-bundle.min.js";
import "/js/helpers/initHtml.js";

const path = resolvesPath(exports, window.location.pathname) ?? [];

if (!path)
  throw new Error(
    `${path}: Não foi possível encontrar a referência da página para serem feitas as importações`
  );

document.addEventListener("DOMContentLoaded", () => {
  path.map(async (currentImport) => {
    try {
      const targetImport = await import(`${currentImport}`);

      targetImport.init();
    } catch (err) {
      throw new Error(`"${currentImport}" -> \n ${err}`);
    }
  });
});
