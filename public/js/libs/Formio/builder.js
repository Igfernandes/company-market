export const builderConfig = {
  builder: {
    basic: false,
    advanced: false,
    data: false,
    customBasic: {
      title: "Padrão",
      default: true,
      weight: 0,
      components: {
        textfield: true,
        textarea: true,
        email: true,
        select: true,
        phoneNumber: true,
        url: true,
        tags: true,
        address: true,
        datetime: true
      },
    },
    custom: {
      title: "Usuário",
      weight: 10,
      components: {
        firstName: {
          title: "Nome",
          key: "firstName",
          icon: "terminal",
          schema: {
            label: "Insira o seu primeiro nome",
            type: "textfield",
            key: "firstName",
            input: true,
          },
        },
        lastName: {
          title: "Sobrenome",
          key: "lastName",
          icon: "terminal",
          schema: {
            label: "Insira o seu sobrenome",
            type: "textfield",
            key: "lastName",
            input: true,
          },
        },
        email: {
          title: "Email",
          key: "email",
          icon: "at",
          schema: {
            label: "Email",
            type: "email",
            key: "email",
            input: true,
          },
        },
        phoneNumber: {
          title: "Celular",
          key: "mobilePhone",
          icon: "phone-square",
          schema: {
            label: "celular",
            type: "phoneNumber",
            key: "mobilePhone",
            input: true,
          },
        },
      },
    },
    layout: {
      components: {
        table: false,
      },
    },
  },
  editForm: {
    textfield: [
      {
        key: "api",
        ignore: true,
      },
    ],
  },
};
