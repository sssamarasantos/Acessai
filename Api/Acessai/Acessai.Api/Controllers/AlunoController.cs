using Acessai.Domain.Dtos;
using Acessai.Domain.Dtos.Login;
using Acessai.Domain.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel.DataAnnotations;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AlunoController : ControllerBase
    {
        private readonly IAlunoService _alunoService;

        public AlunoController(IAlunoService alunoService)
        {
            _alunoService = alunoService;
        }

        [HttpGet("{email}")]
        public async Task<IActionResult> GetEmail([FromRoute][Required] string email)
        {
            var response = await _alunoService.BuscarPorEmailAsync(email);

            if (response == null)
            {
                return NoContent();
            }

            return Ok(response);
        }

        [HttpPost("Cadastro")]
        public async Task<IActionResult> Cadastro([FromBody][Required] AlunoRequest request)
        {
            var response = await _alunoService.CadastrarAsync(request);

            return Ok(response);
        }

        [HttpPost("Login")]
        public async Task<IActionResult> Login([FromBody][Required] LoginRequest request)
        {
            var response = await _alunoService.LoginAsync(request.Email, request.Senha);

            return Ok(response);
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> Atualizar([FromRoute][Required] long id, [FromBody][Required] AlunoRequest request)
        {
            var response = await _alunoService.AtualizarAsync(id, request);

            return Ok(response);
        }
    }
}
