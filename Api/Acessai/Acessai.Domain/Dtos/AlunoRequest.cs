using System.ComponentModel.DataAnnotations;

namespace Acessai.Domain.Dtos
{
    public class AlunoRequest
    {
        [Required(ErrorMessage = "{0} é obrigatório")]
        public string Nome { get; set; }

        [Required(ErrorMessage = "{0} é obrigatório")]
        public string Email { get; set; }

        [Required(ErrorMessage = "{0} é obrigatório")]
        public string Senha { get; set; }

        [Required(ErrorMessage = "{0} é obrigatório")]
        public string Assistencia { get; set; }
    }
}
