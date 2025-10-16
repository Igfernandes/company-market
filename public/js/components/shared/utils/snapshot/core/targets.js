export const getSnapshot = (selector = "") => {
  return document.querySelector(
    `[component='snapshot'][snapshot-target='${selector}']`
  );
};

export const getImage = (snapshot = document.querySelector("")) => {
  return snapshot.querySelector("[component='snapshot:image'] img");
};
export const getInput = (snapshot = document.querySelector("")) => {
  return snapshot.querySelector(
    "[component='snapshot-modal'] [component='snapshot-modal:upload-empty'] input"
  );
};

export const getStyledRules = () => {
  return document.head.querySelector("#snapshot_rules");
};
