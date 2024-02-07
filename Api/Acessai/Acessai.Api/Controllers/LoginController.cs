using Acessai.Domain.Dtos.Login;
using Acessai.Domain.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel.DataAnnotations;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class LoginController : ControllerBase
    {
        private readonly IAlunoService _alunoService;

        public LoginController(IAlunoService alunoService)
        {
            _alunoService = alunoService;
        }

        [HttpPost]
        public async Task<IActionResult> Login([FromBody][Required] LoginRequest request)
        {
            var response = await _alunoService.LoginAsync(request.Email, request.Senha);

            return Ok(response);
        }
    }
}
