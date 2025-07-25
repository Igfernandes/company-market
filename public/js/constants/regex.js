export const VALID_EMAIL_REGEX =
  /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.]+\.[A-Za-z0-9_\-\.])/;
export const uppercaseRegex = /[A-Z]{1}/;
export const lowercaseRegex = /[a-z]{1}/;
export const symbolRegex = /.*[@!#$%^&*()/\\]/;
export const numberRegex = /[0-9]/;
export const telephoneRegex =
  /^\(?[1-9]{2}\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/;
export const VALID_CPF_CNPJ =
  /([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/;
export const sequencialSameLetterUppercaseRegex =
  /AAA|BBB|CCC|DDD|EEE|FFF|GGG|HHH|III|JJJ|KKK|LLL|MMM|NNN|OOO|PPP|QQQ|RRR|SSS|TTT|UUU|VVV|WWW|XXX|YYY|ZZZ|ÇÇÇ/;
export const sequencialSameLetterLowercaseRegex =
  /aaa|bbb|ccc|ddd|eee|fff|ggg|hhh|iii|jjj|kkk|lll|mmm|nnn|ooo|ppp|qqq|rrr|sss|ttt|uuu|vvv|www|xxx|yyy|zzz|ççç/;
export const sequencialNumbersRegex =
  /(012|123|234|345|456|567|678|321|432|543|654|765|789|876|987|000|111|222|333|444|555|666|777|888|999)/;
export const strongPasswordRegex =
  /^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/;
export const minValueRegex = /^(?=.*\d).{5,}$/;
export const urlRegex =
  /^[a-zA-Z0-9-_]+[:./\\]+([a-zA-Z0-9 -_./:=&"'?%+@#$!])+$/;
export const onlySpaces = /^\s+$/;
export const validTokenRegex = /\w{2}\-\w{2}\-\w{2}$/;
export const validCEP = /\d{5}-\d{3}/;
export const VALID_CNPJ = /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/;
export const LENGTH_CHARACTERES = (nu) => /.{5}$/;
