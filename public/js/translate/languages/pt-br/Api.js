import { AuthTranslates } from "./Api/auth.js";
import { BoatsTranslates } from "./Api/boats.js";
import { CategoriesTranslates } from "./Api/categories.js";
import { ClientsTranslates } from "./Api/clients.js";
import { CompaniesTranslates } from "./Api/companies.js";
import { ContactTranslates } from "./Api/contact.js";
import { ExportsTranslates } from "./Api/exports.js";
import { FilesTranslates } from "./Api/files.js";
import { IntegrationsTranslates } from "./Api/integrations.js";
import { InvitesTranslates } from "./Api/invites.js";
import { RecoversTranslates } from "./Api/recovers.js";
import { RolesTranslates } from "./Api/roles.js";
import { UsersTranslates } from "./Api/users.js";

export const API = {
  invalid: {
    recaptcha:
      "A página contém recursos desatualizados. Recarregue e tente novamente.",
  },
  subscribe: {
    success: {
      post: "Você foi inscrito com sucesso!",
    },
  },
  contact: ContactTranslates,
  auth: AuthTranslates,
  recovers: RecoversTranslates,
  exports: ExportsTranslates,
  invites: InvitesTranslates,
  users: UsersTranslates,
  roles: RolesTranslates,
  files: FilesTranslates,
  clients: ClientsTranslates,
  categories: CategoriesTranslates,
  companies: CompaniesTranslates,
  integrations: IntegrationsTranslates,
};
