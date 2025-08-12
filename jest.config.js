export default {
  testEnvironment: "jsdom",
  transform: {
    "^.+\\.js$": "babel-jest",
  },
  moduleNameMapper: {
    "^@libraries/(.*)$": "<rootDir>/public/js/libraries/$1",
    "^@constants/(.*)$": "<rootDir>/public/js/constants/$1",
    "^@helpers/(.*)$": "<rootDir>/public/js/helpers/$1",
  },
};
