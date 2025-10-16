const { TABS, TOOLS } = FilerobotImageEditor;

export const SETTINGS = {
  source: "/imgs/preview/preview-avatar.jpg",
  annotationsCommon: {
    fill: "#ff0000",
  },
  Text: { text: "Filerobot..." },
  Rotate: { angle: 90, componentType: "slider" },
  width: 1000, // 🔒 Largura fixa
  weight: 1000, // 🔒 Altura fixa
  translations: {
    profile: "Profile",
    coverPhoto: "Cover photo",
    facebook: "Facebook",
    socialMedia: "Social Media",
    fbProfileSize: "180x180px",
    fbCoverPhotoSize: "820x312px",
  },
  Crop: {
    autoResize: false,
    cropShape: "circle", // 🔵 Máscara circular
    ratio: 1, // 🔒 Proporção 1:1 (quadrada — que vira círculo com a máscara)
    defaultPosition: "center",
    exportZoom: 1, // Multiplicador do tamanho
    maxWidth: 1000, // largura final esperada
    maxHeight: 1000, // altura final esperada
  },
  export: {
    format: "jpeg", // usar jpeg reduz bastante o tamanho final
    quality: 0.85, // ajuste conforme necessidade (0.7..0.9 recomendado)
    exportType: "base64", // ou "blob"
    exportWidth: 1000,
    exportHeight: 1000,
    showExportResize: false,
    resizeToExportSize: true,
  },
  moreSaveOptions: [],
  tabsIds: [TABS.ADJUST, TABS.ANNOTATE, TABS.RESIZE], // or ['Adjust', 'Annotate', 'Watermark']
  defaultTabId: TABS.ANNOTATE, // or 'Annotate'
  defaultToolId: TOOLS.TEXT, // or 'Text'
};
