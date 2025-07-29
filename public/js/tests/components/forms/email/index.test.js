import { HANDLE_TESTS } from "./handle.test.js";
import { INIT_TESTS } from "./init.test.js";

export const TESTS = {
  ...INIT_TESTS,
  ...HANDLE_TESTS,
};
