import { exportsConfigs } from "./configs.js";
import { exportsExternal } from "./external.js";
import { exportsPanel } from "./panel.js";
import { exportsProfile } from "./profile.js";

export const exports = {
  ...exportsExternal,
  ...exportsPanel,
  ...exportsProfile,
  ...exportsConfigs,
};
